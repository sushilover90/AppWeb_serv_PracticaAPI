<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div>
                    <p class="text-info" v-model="this.riot_token">Riot token actual:</p>
                    <p>{{this.riot_token}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="riot_token">Ingresa tu nuevo riot token:</label>
                <input class="form-control" v-model="new_riot_token" id="riot_token" name="riot_token" type="text">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-12">
                <input class="mt-2 btn btn-block btn-outline-info" v-on:click="Enviar" id="btnEnviarPeticion" type="button" value="Enviar">
            </div>
        </div>
        <div class="row">
            <div id="alert" class="mt-2 col-12">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['datos'],
        data(){
            return {
                riot_token:null,
                user_id:null,
                json_datos:null,
                new_riot_token:null,
                csrf_token:null
            } // return END
        },
        mounted() {
            console.log('Component mounted.');
            this.csrf_token = $('meta[name="csrf-token"]').attr('content');
            this.json_datos = JSON.parse(this.datos);
            this.riot_token = this.json_datos.token_actual;
            this.user_id = this.json_datos.user_id;
        },
        methods: {
            Enviar:function () {
                let self = this;
                $('#alert').empty();
                axios.post('/riottoken',{
                    data:{
                        token : self.new_riot_token
                    },
                    headers:{
                        'x-csrf-token' : self.csrf_token
                    }}).then(function (response){
                        self.riot_token = self.new_riot_token;
                    $('#alert').append('<div class="alert alert-primary" role="alert">\n' +
                        'Petición exitosa' +
                        '</div>');
                }).catch(function (response){
                    console.log(response.error)
                    $('#alert').append('<div class="alert alert-danger" role="alert">\n' +
                        1 +
                        '</div>');
                });
                // this.json_summoner.name="2323";
                // this.summoner_name = "1";
            }
        }
    }
</script>
