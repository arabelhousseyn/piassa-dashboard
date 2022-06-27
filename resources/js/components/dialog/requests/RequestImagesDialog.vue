<template>
    <div class="store-suggestion">
        <v-dialog
            v-model="dialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Images</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-carousel v-if="images.length > 0">
                            <v-carousel-item
                                v-for="(image,i) in images"
                                :key="i"
                                :src="image.path"
                                reverse-transition="fade-transition"
                                transition="fade-transition"
                            ></v-carousel-item>
                        </v-carousel>
                        <p v-else>Pas d'images</p>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="close"
                    >
                        Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    props : ['images','dialog'],
    methods : {
        close()
        {
            this.$emit('close')
        }
    }

}
</script>
