<template>
    <div class="container">
        <div id="banner" class="mb-5">
            <div class="row">
                <div class="col mt-3">
                    <img :src="icon" class="rounded-circle img-fluid img-thumbnail mx-auto d-block" alt="Profile Icon" title="Avatar del Invocador"
                    style="width: 9em; height: 9em;">
                </div>

            </div>
            <div class="row">
                <div class="col text-center">
                    <h3>{{ Summoner.summonerLevel }}</h3>
                    <h1>{{ Summoner.name }}</h1>
                </div>
            </div>
        </div>

        <div id="champs">
            <div class="row justify-content-center">
                <div v-for="(champ, index) in favchampsnames" :key="index" class="card" style="width: 18rem;">
                    <img :src="'/images/' + champ.name + '_0.jpg'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3> {{ champ.name }}</h3>
                        <h4> {{ champ.title }}</h4>

                        <h5 class="card-title">Maestria {{ favchampions[index].championLevel }}</h5>
                        <p class="card-text">{{ champ.details }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['get_icon', 'get_favchampions'],

    data(){
        return{
            icon: "",
            summonerName: "",
            Summoner:{
                id: null,
                accountId: null,
                puuid: null,
                name:"",
                profileIconId: null,
                revisionDate: null,
                summonerLevel: null,
            },
            favchampions: [],
            favchampsnames: [],
        }
    },

    created(){
        this.icon = this.get_icon;
        this.favchampions = JSON.parse(this.get_favchampions);
        console.log(this.favchampions);
        this.summonerName = this.icon.split("/").pop();
        this.summonerName = this.summonerName.replace(".png", "")
        this.summonerName = this.summonerName.replace(" ", "");
        this.Summoner.name = this.SummonerName;
    },

    mounted(){
        this.getInfo();
        this.getChampName();
    },

    methods:{
        getImageurl:function(pic){
            return require('../../../public/Champions/' + pic)
        },
        getInfo:function(){
            let self = this;
            axios.get(`/api/summoner/${this.Summoner.name}`)
            .then(function (response) {
                self.Summoner.id             = response.data.id;
                self.Summoner.accountId      = response.data.accountId;
                self.Summoner.puuid          = response.data.puuid;
                self.Summoner.name           = self.summonerName;
                self.Summoner.profileIconId  = response.data.profileIconId;
                self.Summoner.revisionDate   = response.data.revisionDate;
                self.Summoner.summonerLevel  = response.data.summonerLevel;
            });
        },

        getChampName:function() {
            let self = this;
            for (let index = 0; index < 3; index++) {
                var champid = self.favchampions[index];
                axios.get(`/api/DDragon/${champid['championId']}`)
                .then(function (response){
                    self.favchampsnames.push(response.data);
                });
            }
        },
    }

}
</script>

<style>
    #banner{
        background-image:url(https://pbs.twimg.com/media/ELieqOhW4AENk6M.jpg); background-repeat: no-repeat; background-size: cover; position: relative; background-position: center;
    }
    h1, h3 {
        color: rgb(236, 195, 59);
        text-shadow: 2px 2px 10px rgba(14, 14, 29, 0.863);
    }
    h5 {
        color: rgb(14, 31, 90);
        text-shadow: 0px 0px 5px rgba(255, 227, 150, 0.863);
    }
</style>
