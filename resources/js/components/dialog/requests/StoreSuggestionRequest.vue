<template>
    <div class="store-suggestion">
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
                    Ajouter suggestion <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="text-h5">Ajouter</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <form method="post" @submit.prevent="store">
                                <div v-for="(input,index) in inputs1" :key="index">
                                    <v-col
                                        cols="12"
                                    >
                                        <v-text-field
                                            @change="mutate($event,'M')"
                                            label="Marque*"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                    >
                                        <v-text-field
                                            @change="mutate($event,'P')"
                                            label="Prix*"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                    >
                                        <label for="available">Disponible à*</label>
                                        <br>
                                        <input type="date" @input="mutate($event,'A')" id="available" />
                                    </v-col>
                                </div>

                                <v-btn @click="incrementInput" text dark rounded color="green"><v-icon>mdi-plus</v-icon></v-btn>

                                <v-alert v-if="hasError" border="right" colored-border type="error" elevation="2">
                                    <ul>
                                        <li v-for="(error,index) in errors" :key="index"><span>{{error}}</span></li>
                                    </ul>
                                </v-alert>

                                <v-col cols="12">
                                    <v-btn type="submit" :disabled="disable" color="primary" >

                                        <v-icon v-if="!loading">mdi-plus</v-icon>
                                        <v-progress-circular
                                            v-else
                                            indeterminate
                                            color="primary"
                                        ></v-progress-circular>

                                    </v-btn>
                                </v-col>
                            </form>
                        </v-row>
                    </v-container>
                    <small>*Indique le champ obligatoire</small>
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
    props : ['seller_request_id'],
    data : ()=>({
        date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
        data : {
            marks : null,
            prices : null,
            available_at : null,
            seller_request_id : null
        },
        errors : [],
        hasError : false,
        disable : true,
        dialog : false,
        loading : false,
        inputs1 : 1,
        mark : null,
        price : null,
        available_at : null

    }),
    methods : {
        store()
        {
            this.loading = true
            this.disable = true

            this.data.seller_request_id = this.seller_request_id

          axios.get('/sanctum/csrf-cookie').then(res => {
                axios.post('/api/sellers/sotre-seller-suggestion',this.data).then(e=>{
                    this.$toast.open({
                        message : "Opération effectué",
                        type : 'success',
                    })
                    this.loading = false
                    this.disable = true
                    this.empty()
                    this.dialog = false
                }).catch(err =>{
                    let errors = Object.values(err.response.data.errors)
                    for (const error of errors) {
                        this.errors.push(error[0])
                        this.hasError = true
                        this.loading = false
                        this.disable = false
                    }
                })
            })

        },
        incrementInput()
        {
            this.inputs1++
        },
        empty()
        {
            this.inputs1 = 1
        },
        mutate(data,type)
        {
            switch (type)
            {
                case 'M' : this.mark = data; break;
                case 'P' : this.price = data; break;
                case 'A' : this.available_at = data.target.value; break;
            }

            if(this.mark !== null && this.price !== null && this.available_at !== null)
            {
                this.disable = false
                if(this.data.marks == null)
                {
                    this.data.marks = this.mark
                }else{
                    this.data.marks = `${this.data.marks},${this.mark}`
                }

                if(this.data.prices == null)
                {
                    this.data.prices = this.price
                }else{
                    this.data.prices = `${this.data.prices},${this.price}`
                }

                if(this.data.available_at == null)
                {
                    this.data.available_at = this.available_at
                }else{
                    this.data.available_at = `${this.data.available_at},${this.available_at}`
                }

                this.mark = null
                this.price = null
                this.available_at = null
            }
        }
    },
    mounted() {

    }
}
</script>
