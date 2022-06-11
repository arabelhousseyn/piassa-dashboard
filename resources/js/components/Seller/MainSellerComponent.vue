<template>
    <div class="sellers-data-table">
        <v-container fluid>
            <bread-crumbs-component title1="Vendeurs" link="/home/sellers" icon="mdi mdi-chevron-right" />
            <v-data-table
                :loading="loading"
                loading-text="Chargement... veuillez patienter"
                :headers="headers"
                :items="sellers"
                :search="search"
                disable-sort
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Vendeurs</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <store-seller-dialog />
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
                                <v-list-item link @click="fetchProfile(item.profile)">
                                    <v-list-item-icon><v-icon color="primary">mdi-account</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Compte</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="update(item)">
                                    <v-list-item-icon><v-icon color="primary">mdi-pencil</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Modifier</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="security(item.id)">
                                    <v-list-item-icon><v-icon color="primary">mdi-security</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Sécurité</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="$router.push({name : 'sellerPhones', params : {id : item.id,phones : item.phones} })">
                                    <v-list-item-icon><v-icon color="primary">mdi-phone</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Téléphones</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="$router.push({name : 'sellerJobs',params : {id : item.id,jobs : item.job}})">
                                    <v-list-item-icon><v-icon color="primary">mdi-bag-checked</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Travaux</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item v-if="item.deleted_at == null" link @click="destory(item.id)">
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
        </v-container>
        <seller-profile-dialog v-if="dialog" :dialog="dialog" :profile="profile" @close="close" />
        <seller-delete-dialog @close="close1" :dialog="dialog1" :id="seller_id" />
        <seller-restore-dialog @close="close2" :dialog="dialog2" :id="seller_id" />
        <update-seller-dialog v-if="dialog3" @close="close3" :dialog="dialog3" :data="data" />
        <seller-security-dialog @close="close4" :dialog="dialog4" :user_id="seller_id" />
    </div>
</template>

<script>
import BreadCrumbsComponent from "../BreadCrumbsComponent";
import SellerProfileDialog from "../dialog/Seller/SellerProfileDialog";
import StoreSellerDialog from "../dialog/Seller/StoreSellerDialog";
import SellerDeleteDialog from "../dialog/Seller/SellerDeleteDialog";
import SellerRestoreDialog from "../dialog/Seller/SellerRestoreDialog";
import UpdateSellerDialog from "../dialog/Seller/UpdateSellerDialog";
import SellerSecurityDialog from "../dialog/Seller/SellerSecurityDialog";
export default {
    components: {
        SellerSecurityDialog,
        UpdateSellerDialog,
        SellerRestoreDialog, SellerDeleteDialog, StoreSellerDialog, SellerProfileDialog, BreadCrumbsComponent},
    data : ()=>({
        sellers : [],
        loading : true,
        search : null,
        dialog : false,
        dialog1 : false,
        dialog2 : false,
        dialog3 : false,
        dialog4 : false,
        seller_id : null,
        headers: [
            { text: 'Prénom', value: 'profile.first_name' },
            { text: 'Nom', value: 'profile.last_name' },
            {text: 'Téléphone', value: 'phone'},
            { text: 'Nom commercial', value: 'profile.commercial_name' },
            { text: 'Email', value: 'email' },
            { text: 'Créé à', value: 'created_at' },
            { text: 'Statu', value: 'deleted_at' },
            { text: 'actions', value: 'actions', sortable: false },
        ],
        profile : [],
        data : [],
    }),
    methods : {
        reset()
        {
            this.init()
        },
        fetchProfile(data)
        {
            this.dialog = true
            this.profile = data
        },
        close()
        {
          this.dialog = false
          this.profile = []
        },
        close1()
        {
          this.dialog1 = false
          this.seller_id = null
        },
        close2()
        {
            this.dialog2 = false
            this.seller_id = null
        },
        close3()
        {
            this.dialog3 = false
            this.data = []
        },
        close4()
        {
          this.dialog4 = false
          this.seller_id = null
        },
        init()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/sellers')
                    .then(e =>{
                        this.loading = false
                        this.sellers = e.data.data
                    }).catch(err => {
                    this.$toast.open({message : 'Erreur dans serveur veuillez réessayer',type : 'error'})
                })
            })
        },
        destory(seller_id)
        {
            this.dialog1 = true
            this.seller_id = seller_id
        },
        restore(seller_id)
        {
            this.dialog2 = true
            this.seller_id = seller_id
        },
        update(data)
        {
            this.dialog3 = true
            this.data = data
        },
        security(user_id)
        {
            this.dialog4 = true
            this.seller_id = user_id
        }
    },
    mounted() {
        this.init()
    }
}
</script>
