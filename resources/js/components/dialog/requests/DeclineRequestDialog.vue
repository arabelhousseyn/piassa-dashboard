<template>
    <div class="restore-sign-dialog">
        <v-dialog
            v-model="dialog"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Etes-vous sûr que vous voulez decline !
                </v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="grey darken-1"
                        text
                        @click="close"
                    >
                        <v-icon>mdi-cancel</v-icon>
                    </v-btn>
                    <v-btn
                        v-if="!load"
                        color="success darken-1"
                        text
                        @click="destroy"
                    >
                        <v-icon>mdi-check</v-icon>
                    </v-btn>

                    <v-progress-circular
                        v-else
                        indeterminate
                        color="primary"
                    ></v-progress-circular>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    props : ['dialog','id'],
    data : () =>({
        load : false,
    }),
    methods : {
        destroy()
        {
            this.load = true
            axios.get('/sanctum/csrf-cookie').then(res =>{
                axios.delete(`/api/sellers/requests/delete/${this.id}`).then(e=>{
                    if(e.status == 204)
                    {
                        this.$toast.open({
                            message : 'Opération effectué',
                            type : 'success'
                        })
                        this.load = false
                        window.location.reload()
                    }
                }).catch(err =>{
                    this.$toast.open({
                        message : 'ERROR',
                        type : 'error'
                    })
                })
            })
        },
        close()
        {
            this.$emit('close')
        }
    }
}
</script>
