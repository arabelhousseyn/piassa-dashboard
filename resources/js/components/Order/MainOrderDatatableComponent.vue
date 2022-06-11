<template>
    <div class="users-data-table">
        <v-container fluid>
            <bread-crumbs-component title1="Commandes" link="/home/orders" icon="mdi mdi-chevron-right" />
            <v-data-table
                :loading="loading"
                loading-text="Chargement... veuillez patienter"
                :headers="headers"
                :items="orders"
                :search="search"
                disable-sort
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Commandes</v-toolbar-title>
                    </v-toolbar>
                    <v-toolbar flat>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Recherche"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-toolbar>
                </template>



                <template v-slot:item.actions="{ item }">
                    <v-menu
                        bottom
                        min-width="200"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                dark
                                color="primary"
                                fab
                                small
                                text
                                v-bind="attrs"
                                v-on="on"
                            >
                                <v-icon>mdi-dots-horizontal</v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item-group>
                                <v-list-item link @click="$router.push({name : 'orderItems',params : {id : item.id,data : item.items}}).catch()">
                                    <v-list-item-icon><v-icon color="green">mdi-cart-outline</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Achats</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.events.length > 0" link @click="$router.push({name : 'OrderShipment',params : {id : item.id,data : item.events}}).catch()">
                                    <v-list-item-icon><v-icon color="green">mdi-truck-fast</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Livraison</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item v-if="item.confirmed_by_administrator_at == null" link @click="confirm(item.id)">
                                    <v-list-item-icon><v-icon color="green">mdi-check</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Confirmer</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item v-if="item.deleted_at == null" link @click="destroy(item.id)">
                                    <v-list-item-icon><v-icon color="red">mdi-delete</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Supprimer</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item v-else link @click="restore(item.id)">
                                    <v-list-item-icon><v-icon color="green">mdi-restore</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Restaurer</v-list-item-title></v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-menu>
                </template>

                <template v-slot:item.invoice.path="{ item }">
                    <a v-if="item.invoice !== null" :href="item.invoice.path" target="_blank"><v-icon large>mdi-file-pdf-box</v-icon></a>
                </template>

                <template v-slot:item.items.item.request.request.vehicle.model="{ item }">
                    <span>{{item.items[0].item.request.request.vehicle.model}}</span>
                </template>

                <template v-slot:item.items.item.request.request.vehicle.sign.name="{ item }">
                    <span>{{item.items[0].item.request.request.vehicle.sign.name}}</span>
                </template>

                <template v-slot:item.confirmed_by_administrator_at="{ item }">
                    <v-chip dark v-if="item.confirmed_by_administrator_at == null" color="yellow">
                        En attente
                    </v-chip>
                    <v-chip dark v-else color="green">
                        Confirmé
                    </v-chip>
                </template>


                <template v-slot:item.deleted_at="{ item }">
                    <v-chip dark v-if="item.deleted_at == null" color="green">
                        Active
                    </v-chip>
                    <v-chip dark v-else color="red">
                        Supprimé
                    </v-chip>
                </template>

                <template v-slot:no-data>
                    <v-btn
                        color="primary">
                        Reset
                    </v-btn>
                </template>
            </v-data-table>
            <order-delete-dialog @close="close" :dialog="dialog" :id="selected" />
            <order-restore-dialog @close="close1" :dialog="dialog1" :id="selected" />
            <confirm-order-dialog @close="close2" :dialog="dialog2" :id="selected" />
        </v-container>
    </div>
</template>

<script>
import BreadCrumbsComponent from "../BreadCrumbsComponent";
import OrderDeleteDialog from "../dialog/Order/OrderDeleteDialog";
import OrderRestoreDialog from "../dialog/Order/OrderRestoreDialog";
import ConfirmOrderDialog from "../dialog/Order/ConfirmOrderDialog";
export default {
    components: {ConfirmOrderDialog, OrderRestoreDialog, OrderDeleteDialog, BreadCrumbsComponent},
    data : ()=>({
        dialog : false,
        dialog1 : false,
        dialog2 : false,
        orders : [],
        loading : true,
        selected : null,
        search : null,
        headers: [
            {
                text: 'Ref',
                align: 'start',
                sortable: true,
                value: 'ref',
            },
            { text: 'Livraison', value: 'type_delivery' },
            { text: 'Livreur', value: 'shipper_user_order.shipper.phone' },
            { text: 'Nom utilisateur', value: 'user.profile.full_name' },
            { text: 'Téléphone', value: 'user.phone' },
            { text: 'Modèle', value: 'items.item.request.request.vehicle.model' },
            { text: 'Marque', value: 'items.item.request.request.vehicle.sign.name' },
            { text: 'Sous Total', value: 'amount' },
            { text: 'Facture', value: 'invoice.path' },
            { text: 'Créé à', value: 'created_at' },
            { text: 'Mise à jour à', value: 'updated_at' },
            { text: 'Confirmation', value: 'confirmed_by_administrator_at' },
            { text: 'Statu', value: 'deleted_at' },
            { text: 'actions', value: 'actions', sortable: false },
        ],
    }),
    methods : {
        reset()
        {
            this.init()
        },
        destroy(id)
        {
            this.dialog = true
            this.selected = id
        },
        restore(id)
        {
            this.dialog1 = true
            this.selected = id
        },
        confirm(id)
        {
            this.dialog2 = true
            this.selected = id
        },
        close()
        {
            this.selected = null
            this.dialog = false
        },
        close1()
        {
            this.selected = null
            this.dialog1 = false
        },
        close2()
        {
            this.selected = null
            this.dialog2 = false
        },
        init()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/orders/all')
                    .then(e =>{
                        this.loading = false
                        this.orders = e.data.data
                    }).catch(err => {
                    this.$toast.open({message : 'Erreur dans serveur veuillez réessayer',type : 'error'})
                })
            })
        }
    },
    mounted() {
        this.init()
    }
}
</script>
