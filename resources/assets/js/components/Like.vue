<template>
    <button type="submit" class="btn btn-xs btn-default" @click="likeUnlike">
        <span :class="classes"></span>
        <span v-text="total"></span>
    </button>
</template>

<script>
    export default {
        props: [ 'video', 'count', 'active' ],
        data: function () {
          return { 
            total: this.count,
            pressed: this.active
          }
        },
        computed: {
            classes() {
                return [
                    'glyphicon',
                    this.pressed ? 'glyphicon-heart' : 'glyphicon-heart-empty'
                ];
            },
            likeEndpoint() {
                return '/videos/' + this.video.id + '/likes';
            },
            unlikeEndpoint() {
                return '/videos/' + this.video.id + '/unlikes';
            }
        },
        methods: {
            likeUnlike() {
                this.pressed ? this.unlike() : this.like();
            },
            like() {
                axios.get(this.likeEndpoint);
                this.pressed = true;
                this.total++;
            },
            unlike() {
                axios.get(this.unlikeEndpoint);
                this.pressed = false;
                this.total--;
            }
        }
    }
</script>
