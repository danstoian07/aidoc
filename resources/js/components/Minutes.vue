<template>
    <div>

        <div class="jumbotron text-center">
            <h1 class="display-4">{{ minutes }} Minutes</h1>
        </div>

    </div>
</template>

<script>

    export default {
        name: 'Minutes',
        props: [
            'pacient_code',
            'initial_minutes'
        ],
        data: function () {
            return {
                minutes: this.initial_minutes,
                polling: null
            }
        },
        computed: {

        },
        methods: {
            getMinutes() {
                this.polling = setInterval(() => {

                    axios.get('/get-time/' + this.pacient_code)
                        .then((response) => {
                            this.minutes = response.data.time;
    //                        console.log(response.data)
                        }).catch(function (error) { console.log(error); });

                }, 10000)
            }
        },
        mounted () {
            console.log(this.pacient_code);
            if(this.initial_minutes > 0) {
                this.getMinutes();
            }
        }
    }
</script>

