<template>
    <div class="store-province-dialog">
        <v-dialog
            v-model="dialog"
            persistent
            max-width="600px"
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
                    <span class="text-h5">Ajouter</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <form @submit.prevent="store" method="post">
                            <v-row>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="6"
                                >
                                    <v-text-field
                                        :disabled="disable1"
                                        @keydown="check"
                                        v-model="data.code"
                                        label="Code*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="6"
                                >
                                    <v-text-field
                                        :disabled="disable1"
                                        @keydown="check"
                                        v-model="data.name"
                                        label="Willaya*"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-alert v-if="hasError" border="right" colored-border type="error" elevation="2">
                                    <ul>
                                        <li v-for="(error,index) in errors" :key="index"><span>{{error}}</span></li>
                                    </ul>
                                </v-alert>

                                <v-col cols="12">
                                    <v-btn :disabled="disable" type="submit" color="primary"><v-icon  v-if="!progress">mdi-check</v-icon> <v-progress-circular v-else indeterminate color="white"></v-progress-circular> </v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-container>
                    <small>*Indique le champ obligatoire</small>

                    <div class="d-flex justify-content-center mt-5">
                            <v-file-input
                                label="CSV"
                                color="success"
                                prepend-icon="mdi-file-plus-outline"
                                outlined
                                @change="ImportExcelFile"
                                dense
                                accept=".xlsx,.csv"
                            ></v-file-input>
                    </div>
                    <v-alert v-if="hasError1" border="right" colored-border type="error" elevation="2">
                        <ul>
                            <li v-for="(error,index) in errors1" :key="index"><span>{{error}}</span></li>
                        </ul>
                    </v-alert>
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
        data : {
            name : null,
            code : null,
        },
        disable : true,
        disable1 : false,
        hasError : false,
        errors : [],
        hasError1 : false,
        errors1 : [],
        progress : false,
    }),
    methods : {
        store()
        {
            this.disable = true
            this.progress = true
            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/provinces',this.data).then(e=>{
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
                        this.disable = false
                        this.progress = false
                    }
                })
            })
        },
        ImportExcelFile(file)
        {
            this.hasError1 = false
            this.errors1 = []
            this.disable1 = true
            let data = new FormData
            data.append('file',file)

            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/provinces/excel-import-provinces',data).then(e=>{
                    console.log(e.data)
                    this.$toast.open({
                        message : "Opération effectué",
                        type : 'success',
                    })
                     window.location.reload()
                }).catch(err =>{
                    let errors = Object.values(err.response.data.errors)
                    for (const error of errors) {
                        this.errors1.push(error[0])
                        this.hasError1 = true
                    }
                })
            })
        },
        check()
        {
            this.disable = (this.data.name == null || this.data.code == null) ? true : false
        }
    }
}
</script>
