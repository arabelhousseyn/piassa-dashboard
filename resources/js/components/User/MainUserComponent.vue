<template>
    <div class="users-data-table">
        <v-container fluid>
            <bread-crumbs-component title1="Utilisateurs" link="/home/users" icon="mdi mdi-chevron-right" />
            <v-data-table
                :loading="loading"
                loading-text="Chargement... veuillez patienter"
                :headers="headers"
                :items="users"
                :search="search"
                disable-sort
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Utilisateurs</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <create-user-dialog />
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
                                <v-list-item link @click="openProfile(item)">
                                    <v-list-item-icon><v-icon color="primary">mdi-account</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Compte</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="update(item)">
                                    <v-list-item-icon><v-icon color="primary">mdi-pencil</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Modifier</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.roles[0].name == 'C'" link @click="commercial_info(item.commercial_info)">
                                    <v-list-item-icon><v-icon color="primary">mdi-paperclip</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Document</v-list-item-title></v-list-item-content>
                                </v-list-item>
                                <v-list-item link @click="$router.push({name : 'vehicles', params : {id : item.id,data : item.vehicle}})">
                                    <v-list-item-icon><v-icon color="primary">mdi-car</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Véhicules</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item link @click="$router.push({name :'orders', params : {id : item.id,data : item.orders}})">
                                    <v-list-item-icon><v-icon color="primary">mdi-cart</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Commandes</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item link @click="security(item.id)">
                                    <v-list-item-icon><v-icon color="primary">mdi-security</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Sécurité</v-list-item-title></v-list-item-content>
                                </v-list-item>

                                <v-list-item link @click="notes(item)">
                                    <v-list-item-icon><v-icon color="primary">mdi-fountain-pen-tip</v-icon></v-list-item-icon>
                                    <v-list-item-content><v-list-item-title>Notes</v-list-item-title></v-list-item-content>
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

                <template v-slot:item.roles="{ item }">
                    <v-chip v-if="item.roles[0].name =='P'" color="primary">
                        Particulier
                    </v-chip>
                    <v-chip v-if="item.roles[0].name =='C'" color="primary">
                        Corporate
                    </v-chip>
                    <v-chip v-if="item.roles[0].name =='A'" color="primary">
                        Atelier
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
            <delete-user-dialog @close="close" :dialog="dialog" :id="selected" />
            <restore-user-dialog @close1="close1" :dialog1="dialog1" :id="selected" />
            <user-profile-dialog v-if="dialog2" :dialog="dialog2" @close2="close2" :info="info" :profile="profile" />
            <update-user-dialog v-if="dialog3" :dialog="dialog3" @close3="close3" :data="data" />
            <security-dialog v-if="dialog4" :dialog="dialog4" @close4="close4" :user_id="id" />
            <user-commercial-info v-if="dialog5" :dialog="dialog5" @close5="close5" :commercial_info="info" />
            <user-note-dialog v-if="dialog6" :dialog="dialog6" :data="item" @close="close6" />
        </v-container>
    </div>
</template>

<script>
import DeleteUserDialog from "../dialog/user/DeleteUserDialog";
import RestoreUserDialog from "../dialog/user/RestoreUserDialog";
import CreateUserDialog from "../dialog/user/CreateUserDialog";
import UserProfileDialog from "../dialog/user/UserProfileDialog";
import UpdateUserDialog from "../dialog/user/UpdateUserDialog";
import SecurityDialog from "../dialog/user/SecurityDialog";
import UserCommercialInfo from "../dialog/user/UserCommercialInfo";
import BreadCrumbsComponent from "../BreadCrumbsComponent";
import UserNoteDialog from "../dialog/user/UserNoteDialog";
export default {
    components: {
        UserNoteDialog,
        BreadCrumbsComponent,
        UserCommercialInfo,
        SecurityDialog,
        UpdateUserDialog, UserProfileDialog, CreateUserDialog, RestoreUserDialog, DeleteUserDialog},
    data : ()=>({
        dialog : false,
        dialog1 : false,
        dialog2 : false,
        dialog3 : false,
        dialog4 : false,
        dialog5 : false,
        dialog6 : false,
        id : null,
        users : [],
        profile : [],
        data : [],
        info : [],
        item : null,
        loading : true,
        selected : null,
        search : null,
        headers: [
            {
                text: 'Téléphone',
                align: 'start',
                sortable: true,
                value: 'phone',
            },
            { text: 'Email', value: 'email' },
            { text: 'Role', value: 'roles' },
            { text: 'Notes', value: 'note' },
            { text: 'Créé à', value: 'created_at' },
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
            this.profile = []
            this.info = []
            this.dialog2 = false
        },
        close3()
        {
            this.data = []
            this.dialog3 = false
        },
        close4()
        {
            this.id = null
            this.dialog4 = false
        },
        close5()
        {
            this.dialog5 = false
        },
        close6()
        {
            this.dialog6 = false
            this.item = null
        },
        init()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/users')
                    .then(e =>{
                        this.loading = false
                        this.users = e.data.data
                    }).catch(err => {
                    this.$toast.open({message : 'Erreur dans serveur veuillez réessayer',type : 'error'})
                })
            })
        },
        notes(data)
        {
            this.dialog6 = true
            this.item = data
        },
        openProfile(data)
        {
            this.dialog2 = true
            this.profile = data.profile
            this.info = data.commercial_info
        },
        update(data)
        {
            this.dialog3 = true
            this.data = data
        },
        security(id)
        {
            this.dialog4 = true
            this.id = id
        },
        commercial_info(info)
        {
            this.dialog5 = true
            this.info = info
        }
    },
    mounted() {
        this.init()
    }
}
</script>
