<template>
    <div>


        <div class="row">
            <div class="col s12 m12 l12 py-3 text-center">
                <button type="button" class="btn btn-primary" @click="trainAndRun">Get AiDoc Diagnostic</button>
            </div>
        </div>

        <div class="row" v-if="brain_data.length !== 0">
            <div class="col s12 m12 l12 pb-3">
                <div class="header"><h6>Probably:</h6></div>
                <ul class="list-group">
                    <li class="list-group-item"
                        v-if="percent > 0.1"
                        :class="{ primary: percent > 0.8 }"
                        v-for="(percent, index) in brain_data">{{ index.replace("_", " ") }} : {{ Math.round(percent * 10000) / 100}} %</li>
                </ul>
            </div>
        </div>


    </div>
</template>

<script>

    const brain = require('brain.js');
    const net = new brain.NeuralNetwork();

    const training_data = [
        {input: { }, output: { Not_Sick: 1 }},
        {input: { }, output: { Not_Sick: 1 }},
        {input: { body_ache: 1, congestion: 1, cough: 1, fever: 1, headache: 1, malaise: 1, runny_nose: 1, sneezing: 1, sore_throat: 1 }, output: { Common_Cold: 1 }},
        {input: { breathing_problems: 1, eczema: 1, hives: 1, red_eyes: 1, runny_nose: 1, sneezing: 1 }, output: { Allergy: 1 }},
        {input: { dizziness: 1, dry_skin: 1, headache: 1, red_skin: 1 }, output: { Sun_Stroke: 1 }},
        {input: { bleeding: 1, dizziness: 1 }, output: { Hemorrhage: 1 }},
        {input: { malaise: 1, no_symptoms: 1 }, output: { Hepatitis: 1 }},
        {input: { cough: 1, fever: 1, hives: 1, red_eyes: 1, runny_nose: 1, sore_throat: 1 }, output: { Measles: 1 }},
        {input: { fatigue: 1, fever: 1, headache: 1, hives: 1, malaise: 1 }, output: { Chickenpox: 1 }},
        {input: { red_eyes: 1 }, output: { Conjunctivitis: 1 }},
        {input: { fever: 1, nausea: 1, painful_urination: 1, vomiting: 1 }, output: { Kidney_stone: 1 }},
        {input: { fatigue: 1, fever: 1, headache: 1, seizures: 1, vomiting: 1, yellow_skin: 1 }, output: { Malaria: 1 }},
        {input: { headache: 1, nausea: 1, vomiting: 1 }, output: { Migraine: 1 }}
    ];

    export default {
        name: 'Symptoms',
        props: [
            'symptoms'
        ],
        data: function () {
            return {
                brain_data: [],
            }
        },
        computed: {
            test: function () {
                return JSON.parse(this.symptoms)
            }
        },
        methods: {
            trainAndRun() {
                net.train(training_data);
                this.brain_data = net.run(this.test);
            }

        },
        mounted () {
            console.log(this.symptoms);
            console.log(this.test);
        }
    }
</script>


<style>
    .primary {
        color: #fff;
        background-color: #4a5aff !important;
    }

</style>
