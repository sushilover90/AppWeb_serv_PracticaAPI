<template>
    <div class="container">
        <div id="banner" class="mb-5">
            <div class="row justify-content-center">
                    <div class="col-sm-3 mt-3 text-center">
                        <img :src="icon" class="rounded-circle mx-auto img-fluid img-thumbnail d-block" alt="Profile Icon" title="Avatar del Invocador"
                        style="width: 9em; height: 9em;">
                        <h3>{{ Summoner.summonerLevel }}</h3>
                        <h1>{{ Summoner.name }}</h1>
                    </div>
                    <div class="col-sm-3 mt-3 text-center">
                        <img src="/images/emblems/Emblem_Challenger.png" class="mx-auto rounded-circle img-fluid img-thumbnail d-block"
                        style="width: 9em; height: 9em;" alt="">
                        <h3>500 PL</h3>
                        <h1>Retador</h1>
                    </div>

                </div>
            <div class="row justify-content-center">

            </div>
            <div>Platino</div>
        </div>

        <div id="champs">
            <div class="row justify-content-center">
                <div v-for="(champ, index) in favchampsnames" :key="index" class="card mx-3" style="width: 21rem;">
                    <img :src="'/images/' + champ.name + '_0.jpg'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text-center">
                            <h3> {{ champ.name }}</h3>
                            <h4> {{ champ.title }}</h4>
                        </div>

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

        getRankedPosition:function(){
            let self = this;
            axios.get(`/api/RankedPos/${this.Summoner.id}`)
            .then(function (response){

            });
        }
    }

}
</script>

<style>
    #banner{
        background-image:url('https://nexus.leagueoflegends.com/wp-content/uploads/2019/10/Banner_Preseason-1_dwfwpnp0byzkpe2hk65v.jpg'); background-repeat: no-repeat; background-size: cover; position: relative; background-position: center;
    }
    h1, h3 {
        color: rgb(182, 149, 41);
        text-shadow: 2px 2px 10px rgba(244, 255, 95, 0.425);
    }
    h5 {
        color: rgb(14, 31, 90);
        text-shadow: 0px 0px 5px rgba(255, 227, 150, 0.863);
    }
</style>
