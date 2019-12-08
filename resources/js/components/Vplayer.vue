<template>
    <video-player  class="video-player-box"
                   ref="videoPlayer"
                   :options="playerOptions"
                   :playsinline="true"
                   customEventName="customstatechangedeventname"

                   @play="onPlayerPlay($event)"
                   @pause="onPlayerPause($event)"
                   @ended="onPlayerEnded($event)"
                   @waiting="onPlayerWaiting($event)"
                   @playing="onPlayerPlaying($event)"
                   @loadeddata="onPlayerLoadeddata($event)"
                   @timeupdate="onPlayerTimeupdate($event)"
                   @canplay="onPlayerCanplay($event)"
                   @canplaythrough="onPlayerCanplaythrough($event)"

                   @statechanged="playerStateChanged($event)"
                   @ready="playerReadied">
    </video-player>
</template>

<script>
    // Similarly, you can also introduce the plugin resource pack you want to use within the component
    // import 'some-videojs-plugin'
    export default {
        props:['source'],
        data() {
            return {
                playerOptions: {
                    // videojs options
                    muted: true,
                    language: 'en',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    sources: [{
                        type: "video/mp4",
                        src: this.source,
                    }],
                    height:"500",
                    width:"500",
                    poster: "",
                }
            }
        },
        mounted() {
            console.log('this is current player instance object', this.player)
        },
        computed: {
            player() {
                return this.$refs.videoPlayer.player
            }
        },
        methods: {
            // listen event
            onPlayerPlay(player) {
                // console.log('player play!', player)
            },
            onPlayerPause(player) {
                // console.log('player pause!', player)
            },
            // ...player event

            // or listen state event
            playerStateChanged(playerCurrentState) {
                // console.log('player current update state', playerCurrentState)
            },

            // player is ready
            playerReadied(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerLoadeddata(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            }
            ,
            onPlayerEnded(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerWaiting(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerPlaying(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerTimeupdate(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerCanplay(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            },
            onPlayerCanplaythrough(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            }
        }
    }
</script>
<style>
    video{
        width:300px;
        height:400px;
    }
</style>
