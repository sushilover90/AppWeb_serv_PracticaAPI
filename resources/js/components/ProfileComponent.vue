<template>
    <div class="container">
        <div id="banner" class="mb-5">
            <div class="row justify-content-center">
                <div class="col-sm-3 mt-3 text-center">
                    <img :src="icon" class="rounded-circle mx-auto img-fluid img-thumbnail d-block" alt="Profile Icon" title="Avatar del Invocador"
                    style="width: 9em; height: 9em;">
                    <h3>Nivel: {{ Summoner.summonerLevel }}</h3>
                    <h1>{{ Summoner.name }}</h1>
                </div>
                <div class="col-sm-3 mt-3 text-center">
                    <img :src="'/images/emblems/Emblem_' +  Ranked.tier + '.png'" class="mx-auto rounded-circle img-fluid d-block"
                    style="width: 9em; height: 9em;" alt="">
                    <h3>{{ Ranked.leaguePoints }} Puntos Liga</h3>
                    <h1>{{ Ranked.tier}}</h1>
                    <p id="wl">{{ Ranked.wins }} Victorias, {{ Ranked.losses }} Derrotas</p>
                </div>
            </div>
        </div>

        <div id="champs">
            <h2 style="padding: 1em;">Campeones favoritos</h2>
            <div class="row justify-content-center">
                <div v-for="(champ, index) in favchampsnames" :key="index" class="card mx-3" style="width: 21rem; background: rgb(10, 20, 37);">
                    <img :src="'/images/' + champ.name + '_0.jpg'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text-center">
                            <h3> {{ champ.name }}</h3>
                            <h4> {{ champ.title }}</h4>
                        </div>

                        <h3 class="card-title">Maestria {{ champ.championLevel }}</h3>
                        <p> <span>{{ champ.championPoints}} </span> puntos de maestria</p>
                        <p class="card-text">{{ champ.details }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="matchs" class="mt-3">
            <h2 style="padding: 1em;">Historial de partidas recientes</h2>
            <div class="row justify-content-start my-3 p-3" style="background: rgb(10, 20, 37);" v-for="(match , index) in Matchs" :key="index">
                <div class="form-inline">
                    <img :src="'/images/littlei/' + match.champion + '_0.JPG'" class="mx-auto img-fluid img-thumbnail"
                        style="width: 5em; height: 5em;" alt="CHAMPION ICON">
                    <div class="ml-4">
                        <h3> {{match.champion}}</h3>
                        <h4>{{match.map}}</h4>
                    </div>
                    <div class="ml-4">
                        <p>{{match.desc}}</p>
                        <p>{{match.Resultado}}</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props:['sm'],

    data(){
        return{
            icon: "",
            Summoner:{
                id: null,
                accountId: null,
                puuid: null,
                name: null,
                profileIconId: null,
                revisionDate: null,
                summonerLevel: null,
            },
            Ranked:{
                leagueId: null,
                queueType: null,
                tier: "PROVISIONAL",
                rank: "v",
                summonerId: null,
                summonerName: null,
                leaguePoints: 0,
                wins: 0,
                losses: 0,
                veteran: null,
                inactive: null,
                freshBlood: null,
                hotStreak: null,
            },
            favchampsnames: [],
            Matchs: [],
            path: null,
        }
    },

    created(){
        this.path = this.sm;
    },

    mounted(){
        this.getAllProfileInfo();

    },

    methods:{
        getAllProfileInfo:function(){
            let self = this;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.api_token;
            axios.get(`/api/${this.path}`, {
                data:{
                    summoner_name: self.path
                },
            }).then(function (response){
                self.icon = response.data.icon;
                self.Summoner = response.data.user;
                if (response.data.ranked != 'U') {
                    self.Ranked = response.data.ranked;
                }
                self.favchampsnames = response.data.fav;
                self.Matchs = response.data.matchs;
            });
        }
    },
}
</script>

<style>
    #banner{
        background-image:url('https://nexus.leagueoflegends.com/wp-content/uploads/2019/10/Banner_Preseason-1_dwfwpnp0byzkpe2hk65v.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        background-position: center;
    }
    h1, h3, span {
        color: rgb(182, 149, 41);
        text-shadow: 2px 2px 10px rgba(244, 255, 95, 0.425);
        border-radius: 3rem;
    }
    h5 {
        color: rgb(10, 20, 37);
        text-shadow: 0px 0px 5px rgba(255, 227, 150, 0.863);
    }
    #wl {
        background: rgba(180, 173, 39, 0.445);
        color: rgb(255, 255, 255);
        border-radius: 5em;
    }
</style>
