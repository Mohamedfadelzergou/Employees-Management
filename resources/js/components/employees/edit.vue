<template>
  <div>
      <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Employee
                            <router-link :to="{name:'EmployeesIndex'}" class="float-right btn btn-success">Back</router-link>
                        </div>

                        <div class="card-body">
                            <form @submit.prevent="UpdateEmployee">
                                <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First name</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" v-model="form.first_name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="middle_name" class="col-md-4 col-form-label text-md-right">Middle name</label>

                                    <div class="col-md-6">
                                        <input id="middle_name" type="text" v-model="form.middle_name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Last name</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" v-model="form.last_name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" v-model="form.address" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                                    <div class="col-md-6">
                                        <select id="country" v-model="form.country_id" @change="getStates()"  class="form-control form-select" aria-label="Default select example">
                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{country.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                                    <div class="col-md-6">
                                    <select id="state" v-model="form.state_id" @change="getCities()" class="form-control form-select" aria-label="Default select example">
                                            <option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="departement" class="col-md-4 col-form-label text-md-right">Departement</label>

                                    <div class="col-md-6">
                                        <select id="departement" v-model="form.department_id" class="form-control form-select" aria-label="Default select example">
                                            <option v-for="department in departments" :key="department.id" :value="department.id">{{department.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                                    <div class="col-md-6">
                                        <select id="city" v-model="form.city_id" class="form-control form-select" aria-label="Default select example">
                                            <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="zip_code" class="col-md-4 col-form-label text-md-right">Zip code</label>

                                    <div class="col-md-6">
                                        <input id="zip_code" v-model="form.zip_code" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="birthdate" class="col-md-4 col-form-label text-md-right">Birthdate</label>

                                    <div class="col-md-6">
                                        <datepicker id="birthdate" v-model="form.birthdate" input-class="form-control"></datepicker>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="date_hired" class="col-md-4 col-form-label text-md-right">Date Hired </label>

                                    <div class="col-md-6">
                                        <datepicker id="date_hired" v-model="form.date_hired" input-class="form-control"></datepicker>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from'moment';
export default {
    components:{
        Datepicker
    },
    data(){
        return{
            countries:[],
            states:[],
            cities:[],
            departments:[],
            form:{
                first_name:'',
                middle_name:'',
                last_name:'',
                address:'',
                department_id:'',
                country_id:'',
                state_id:'',
                city_id:'',
                zip_code:'',
                birthdate:null,
                date_hired:null
            }
        }
    },
    created(){
        this.getCountries();
        this.getDepartments();
        this.getEmployee();
    },
    methods:{
        getEmployee(){
            axios.get('/api/employees/'+this.$route.params.id).then(res=>{
                this.form=res.data.data;
                this.getStates();
                this.getCities();
            }).catch(error => {
                console.log(console.error)
            });
        },
        getCountries(){
            axios.get('/api/employees/countries').then(res=>{
                this.countries=res.data;
            }).catch(error => {
                console.log(console.error)
            });
        },
        getStates(){
                axios.get('/api/employees/'+this.form.country_id+'/states').then(res=>{
                this.states=res.data;
            }).catch(error => {
                console.log(console.error)
            });
        },
        getDepartments(){
            axios.get('/api/employees/departments').then(res=>{
                this.departments=res.data;
            }).catch(error => {
                console.log(console.error)
            });
        },
        getCities(){
            axios.get('/api/employees/'+this.form.state_id+'/cities').then(res=>{
                this.cities=res.data;
            }).catch(error => {
                console.log(console.error)
            });
        },
        UpdateEmployee(){
            axios.put('/api/employees/'+this.$route.params.id,{
                'first_name':this.form.first_name,
                'middle_name':this.form.middle_name,
                'last_name':this.form.last_name,
                'address':this.form.address,
                'department_id':this.form.department_id,
                'country_id':this.form.country_id,
                'state_id':this.form.state_id,
                'city_id':this.form.city_id,
                'zip_code':this.form.zip_code,
                'birthdate':this.format_date(this.form.birthdate),
                'date_hired':this.format_date(this.form.date_hired)
            }).then(res=>{
                this.$router.push({name:'EmployeesIndex'});
            });
        },
        format_date(value){
            if(value){
                return moment(String(value)).format('YYYYMMDD');
            }
        }
    }
}
</script>