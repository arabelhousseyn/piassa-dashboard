<template>
    <div class="store-seller-dialog">
        <v-dialog
            v-model="dialog"
            persistent
            max-width="700px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="primary"
                    dark
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon>mdi-plus</v-icon> Ajouter
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="text-h5">Créer un vendeur</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <form @submit.prevent="store" method="post">
                            <v-row>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        label="Nom*"
                                        v-model="data.first_name"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.last_name"
                                        label="Prénom*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.phone"
                                        label="Téléphone*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.email"
                                        type="email"
                                        label="Email"
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.password"
                                        type="password"
                                        label="Mote de passe*"
                                        required
                                    ></v-text-field>
                                </v-col>


                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.password_confirmation"
                                        type="password"
                                        label="Confirmation mote de passe*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        @keydown="check"
                                        v-model="data.commercial_name"
                                        label="Nom commercial*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-select
                                        @change="check"
                                        v-model="data.condition"
                                        :items="conditions"
                                        label="Condition*"
                                    ></v-select>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-select @change="check" v-model="selectedProvince" :items="items" placeholder="Willayas *"></v-select>
                                </v-col>

                                <v-col cols="12">
                                    <v-textarea
                                        @change="check"
                                        v-model="data.job"
                                        label="Description de l'emploi"
                                        hint="Description de l'emploi"
                                    ></v-textarea>
                                </v-col>

                                <v-col cols="12" sm="6" md="6">
                                    <v-combobox
                                        @change="check"
                                        v-model="selectedSigns"
                                        :items="items1"
                                        label="Marques*"
                                        multiple
                                        outlined
                                        dense
                                    ></v-combobox>

                                    <v-checkbox
                                        @change="VerifyCheck"
                                        v-model="checkAll"
                                        label="Sélectionner tout"
                                    ></v-checkbox>
                                </v-col>

                                <v-col cols="12" sm="6" md="6">
                                    <v-combobox
                                        @change="check"
                                        v-model="selectedTypes"
                                        :items="items2"
                                        label="Types*"
                                        multiple
                                        outlined
                                        dense
                                    ></v-combobox>
                                </v-col>

                                <v-alert v-if="hasError" border="right" colored-border type="error" elevation="2">
                                    <ul>
                                        <li v-for="(error,index) in errors" :key="index"><span>{{error}}</span></li>
                                    </ul>
                                </v-alert>
                                <v-col cols="12">
                                    <v-btn type="submit" :disabled="disabled" color="primary"><v-icon v-if="!progress">mdi-check</v-icon> <v-progress-circular v-else indeterminate color="white"></v-progress-circular></v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-container>
                    <small>*indique le champ obligatoire</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="dialog = false"
                    >
                        Fermer
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    data : ()=>({
        dialog : false,
        selectedProvince : null,
        data : {
            phone : null,
            first_name : null,
            last_name : null,
            province_id : null,
            commercial_name : null,
            condition : null,
            job : null,
            types : [],
            signs : []
        },
        items : [],
        items1 : [],
        items2 : [],
        provinces : [],
        hasError : false,
        errors : [],
        disabled : true,
        progress : false,
        fruits : [],
        fruits1 : [],
        signs : [],
        types : [],
        selectedSigns : [],
        selectedTypes : [],
        conditions : ['new','used'],
        checkAll : false,
    }),
    methods : {
        VerifyCheck()
        {
            if(!this.checkAll)
            {
                this.selectedSigns = []
            }else{
                if(this.selectedSigns.length > 0)
                {
                    this.selectedSigns = []
                }

                this.signs.map((sign)=>{
                    this.selectedSigns.push(sign.name)
                })
            }
        },
        async init()
        {
            await axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/provinces').then(e=>{
                    this.provinces = e.data
                    for (const province of e.data) {
                        this.items.push(province.name)
                    }
                }).catch(err =>{
                    this.$toast.open({
                        message : "ERROR",
                        type : 'error'
                    })
                })
            })


            await axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/signs/all').then(e=>{
                    this.signs = e.data.data
                    for (const sign of e.data.data) {
                        this.items1.push(sign.name)
                    }
                }).catch(err =>{
                    console.log(err)
                    this.$toast.open({
                        message : "ERROR",
                        type : 'error'
                    })
                })
            })

            await axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.get('/api/types/all').then(e=>{
                    this.types = e.data.data
                    for (const type of e.data.data) {
                        this.items2.push(type.name)
                    }
                }).catch(err =>{
                    console.log(err)
                    this.$toast.open({
                        message : "ERROR",
                        type : 'error'
                    })
                })
            })
        },
        check()
        {
            this.hasError = false
            this.errors = []
           this.disabled = (this.data.phone == null || this.data.condition == null || this.data.commercial_name == null
            || this.data.first_name == null || this.data.last_name == null || this.selectedProvince == null
            || this.selectedTypes.length == 0 || this.selectedSigns.length == 0) ? true : false

        },
        store()
        {
            // store the signs id's to the array of signs into the data object
            for (const sign of this.selectedSigns) {
                for (let i= 0;i<this.signs.length;i++)
                {
                    if(sign == this.signs[i].name)
                    {
                        this.data.signs.push({
                            sign_id : this.signs[i].id
                        })
                    }
                }
            }

            // store the types id's to the array of types into the dara object
            for (const type of this.selectedTypes) {
                for (let i= 0;i<this.types.length;i++)
                {
                    if(type == this.types[i].name)
                    {
                        this.data.types.push({
                            type_id : this.types[i].id
                        })
                    }
                }
            }

            this.progress = true
            this.disabled = true
            for (const province of this.provinces) {
                if(province.name == this.selectedProvince)
                {
                    this.data.province_id = province.id
                    break;
                }
            }

            if(this.data.email !== undefined)
            {
                delete this.data.email
            }


            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/sellers',this.data).then(e=>{
                    this.$toast.open({
                        message : "Opération effectué",
                        type : 'success',
                    })
                    window.location.reload()
                }).catch(err =>{
                    let errors = Object.values(err.response.data.errors)
                    for (const error of errors) {
                        this.errors.push(error[0])
                        this.hasError = true
                        this.progress = false
                        this.disabled = false
                    }
                })
            })
        }
    },
    mounted() {
        this.init()
    }
}
</script>
