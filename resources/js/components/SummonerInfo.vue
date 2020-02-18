<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div>
                    <p><span class="text-info">Id :</span> <span>{{json_summoner.id}}</span></p>
                    <p><span class="text-info">AccountId :</span> <span>{{json_summoner.accountId}}</span></p>
                    <p><span class="text-info">Puuid :</span> <span>{{json_summoner.puuid}}</span></p>
                    <p><span class="text-info">Name :</span> <span>{{json_summoner.name}}</span></p>
                    <p><span class="text-info">ProfileIconId :</span> <span>{{json_summoner.profileIconId}}</span></p>
                    <p><span class="text-info">RevisionDate :</span> <span>{{json_summoner.revisionDate}}</span></p>
                    <p><span class="text-info">SummonerLevel :</span> <span>{{json_summoner.summonerLevel}}</span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="summoner_name">Ingresa tu summoner name:</label>
                <input class="form-control" v-model="summoner_name" id="summoner_name" name="summoner_name" type="text">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-12">
                <input style="display: inline-block;" class="mt-2 btn btn-block btn-outline-info" v-on:click="Enviar" id="btnEnviarPeticion" type="button" value="Enviar">
            </div>
            <div class="col-lg-3 col-12" id="verMasDetalles">

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
    data(){
        return {
            summoner_name:null,
            json_summoner:{
                id: null,
                accountId: null,
                puuid: null,
                name: null,
                profileIconId: null,
                revisionDate: null,
                summonerLevel: null
            },
        }
    },
    created() {
        axios.get('/api_token')
        .then(function (response){
            localStorage.api_token = response.data;
        });
    },

    mounted() {
        console.log(localStorage.api_token);
    },

    methods: {
        Enviar:function () {
            let self = this;
            $('#alert').empty();
            $('#verMasDetalles').empty();
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.api_token;
            axios.post('/api/summoner/', {
                data:{
                    summoner_name: self.summoner_name,
                }
            })
            .then(function (response){
                self.json_summoner.id=response.data.id;
                self.json_summoner.accountId=response.data.accountId;
                self.json_summoner.puuid=response.data.puuid;
                self.json_summoner.name=response.data.name;
                self.json_summoner.profileIconId=response.data.profileIconId;
                self.json_summoner.revisionDate=response.data.revisionDate;
                self.json_summoner.summonerLevel=response.data.summonerLevel;
                $('#verMasDetalles').append('<a href="/profile/'+self.json_summoner.name+'" class="mt-2 btn btn-block btn-outline-info">Ver mas detalles</a>');
                $('#alert').append('<div class="alert alert-primary" role="alert">\n' +
                'Petición exitosa' +
                '</div>');
            }).catch(function (response){
                $('#alert').append('<div class="alert alert-danger" role="alert">\n' +
                    'Petición no exitosa, verifica bien tu summoner name y vuelve a intentarlo, de lo contrario, intenta más tarde.' +
                    '</div>');
            });
        }
    }
}
</script>

<style>
        h1, h2, h3, h4, h5, p, span{ background: rgb(10, 20, 37);
            border-color: rgb(182,149,41);
            color: rgb(182,149,41); }
</style>
