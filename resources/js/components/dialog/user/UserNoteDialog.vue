<template>
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
                <span class="text-h5">Créer un utilisateur</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form @submit.prevent="create" method="post">
                        <v-row>
                            <v-col
                                cols="12"
                            >
                                <v-textarea
                                    outlined
                                    v-model="data.note"
                                    name="input-7-4"
                                    label="Note"></v-textarea>
                            </v-col>

                            <v-alert v-if="hasError" border="right" colored-border type="error" elevation="2">
                                <ul>
                                    <li v-for="(error,index) in errors" :key="index"><span>{{error}}</span></li>
                                </ul>
                            </v-alert>
                            <v-col cols="12">
                                <v-btn type="submit" color="primary"><v-icon v-if="!progress">mdi-check</v-icon> <v-progress-circular v-else indeterminate color="white"></v-progress-circular></v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-container>
                <small>*indique le champ obligatoire</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="close"
                >
                    Cancel
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    props : ['data','dialog'],
    data: () => ({
        show : false,
        errors : [],
        hasError : false,
        progress : false,
        formatedData : {
            user_id : null,
            note : null
        }

    }),
    methods : {
        create()
        {
            this.formatedData.user_id = this.data.id
            this.formatedData.note = this.data.note
            console.log(this.formatedData)
            this.progress = true
            axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/users/store-note',this.formatedData).then(e=>{
                    this.$toast.open({
                        message : "Opération effectué",
                        type : 'success',
                    })
                    this.progress = false
                    this.empty()
                    this.$emit('close')
                }).catch(err =>{
                    let errors = Object.values(err.response.data.errors)
                    for (const error of errors) {
                        this.errors.push(error[0])
                        this.hasError = true
                        this.progress = false
                    }
                })
            })
        },
        close()
        {
            this.$emit('close')
        },
        empty()
        {
            this.formatedData.note = null
            this.formatedData.user_id = null
        }
    }
}
</script>
