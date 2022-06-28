<template>
    <div class="dashboard">
        <audio id="myAudio">
            <source src="storage/notification.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <progress-circular-component />
            <header-component />
            <v-main v-if="!isLoading">
                <router-view />
            </v-main>
        <footer-component />
        </div>
</template>

<script>
import ProgressCircularComponent from "../components/ProgressCircularComponent";
import HeaderComponent from "../components/HeaderComponent";
import FooterComponent from "../components/FooterComponent";
import Echo from "laravel-echo";
export default {
    data : () =>({
       isLoading : true,
    }),
    components: {FooterComponent, HeaderComponent, ProgressCircularComponent},
    methods : {
        enableNotification(data,type)
        {
            if(localStorage.getItem('permission') == 'granted')
            {
                let notification;
                if(type == 'order')
                {
                     notification = new Notification('Nouvelle notification',{
                        vibrate : true,
                        body : `Numéro de commande : ${data.data.ref}`,
                        badge : ""
                    })

                    this.$store.commit('INCREMENT_NOTIFICATION',1)
                    this.playSound()
                    notification.addEventListener('click',()=>{
                        this.$router.push('/home/orders')
                        notification.close()
                    })
                }

                if(type == 'request')
                {
                     notification = new Notification('Nouvelle notification',{
                        vibrate : true,
                        body : `Nouvelle demande`,
                        badge : ""
                    })

                    this.playSound()
                    notification.addEventListener('click',()=>{
                        this.$router.push('/home/requests')
                        notification.close()
                    })
                }
            }
        },
        playSound()
        {
            var x = document.getElementById("myAudio")
            //let audio = new Audio(sound)
            x.play()
        }
    },
     mounted() {
        if(Notification.permission == 'denied')
        {
            let permission = Notification.requestPermission();
            localStorage.setItem('permission',permission)
        }else{
            localStorage.setItem('permission','granted')
        }

        axios.defaults.headers.common['Authorization'] = `Bearer ${this.$store.state.user.token}`
        axios.get('/sanctum/csrf-cookie').then(res =>{
            axios.get('/api/company/data')
            .then(e =>{
                this.isLoading = false
                this.$store.commit('SET_DATA',e.data)
            }).catch(err => {
                this.$toast.open({message : 'Erreur dans serveur veuillez réessayer',type : 'error'})
            })
        })

         var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
             cluster: process.env.MIX_PUSHER_APP_CLUSTER
         });

         var channel = pusher.subscribe('admin');
         var channel2 = pusher.subscribe('admin');
         channel.bind('order-event', this.enableNotification)
         channel2.bind('request-event',this.enableNotification)
    }
}
</script>
