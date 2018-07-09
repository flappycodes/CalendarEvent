<template>
	<div class="container-fluid">
        <h1>Calendar Event</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="event_title">Event Title</label>
                    <input type="text" class="form-control" name="event_title" v-model="event_title" placeholder="Event Title">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="event_from">From</label>
                            <input type="date" class="form-control" name="event_from" v-model="event_from" placeholder="Date From">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="event_to">To</label>
                            <input type="date" class="form-control" name="event_to" v-model="event_to" placeholder="Dater To">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="monday" id="monday" name="monday">
                            <label class="form-check-label" for="monday">Mon</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="tuesday" id="tuesday" name="tuesday">
                            <label class="form-check-label" for="tuesday">Tue</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="wednesday" id="wednesday" name="wednesday">
                            <label class="form-check-label" for="wednesday">Wed</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="thursday" id="thursday" name="thursday">
                            <label class="form-check-label" for="thursday">thu</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="friday" id="friday" name="friday">
                            <label class="form-check-label" for="friday">Fri</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="saturday" id="saturday" name="saturday">
                            <label class="form-check-label" for="saturday">Sat</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="sunday" id="sunday" name="sunday">
                            <label class="form-check-label" for="sunday">Sun</label>
                        </div>
                    </div>
                </div>
                <hr>
                <button @click="save()" class="btn btn-primary">Save</button>
            </div>
            <div class="col-md-8">
                <h2 v-text="months"></h2>
                <table class="table">
                    <tbody>
                        <tr v-for="day in days" :class="day.type" v-if="">
                            <td v-text="day.day" width="15%"></td>
                            <td v-text="day.event" width="*"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                event_title: '',
                event_from: '',
                event_to: '',
                monday: '',
                tuesday: '',
                wednesday: '',
                thursday: '',
                friday: '',
                saturday: '',
                sunday: '',
                months: '',
                message: 'Hello world!',
                days: []
            }
        },
        mounted() {
            axios.get('api/index').then(
                response => { 
                    this.days = response.data.dates; 
                    this.months = response.data.header;
                }
            );
        },
        methods: {
            save: function () {
                let data = {
                    event_title: this.event_title,
                    event_from: this.event_from,
                    event_to: this.event_to,
                    monday: this.monday,
                    tuesday: this.tuesday,
                    wednesday: this.wednesday,
                    thursday: this.thursday,
                    friday: this.friday,
                    saturday: this.saturday,
                    sunday: this.sunday
                }

                if (this.event_title == '' || this.event_from == '' || this.event_to == '') {
                    toastr.error('Empty Feilds!');
                }else{
                    axios.post('api/create', data)
                        .then(response => {
                            toastr.success('Event is successfully created!');
                            this.days = response.data.dates; 
                            this.months = response.data.header;
                        })
                }
            }
        }
    }
</script>