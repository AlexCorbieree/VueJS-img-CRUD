const api = "http://localhost/vuejs/api.php"

const app = Vue.createApp({
    data() {
        return{
            // message : "Hola Vue",
            modalCreate:false,
            users:[]
        }
    },
    mounted(){
        this.getUsers()
    },
    methods:{
        getUsers(){
            axios.get(api+"?opc=list")
            .then(function(response){
                app.users = response.data.users
            })
        },
        insertUser(){
            let fd = new FormData()
            fd.append('name', document.getElementById('name').value)
            fd.append('email', document.getElementById('email').value)
            fd.append('image', document.getElementById('image').files[0])
            
            console.log(fd);

            axios.post(api+"?opc=create", fd)
            .then(function(response){
                console.log(response.data)
                app.getUsers()
            })
        }
    }

}).mount("#app")