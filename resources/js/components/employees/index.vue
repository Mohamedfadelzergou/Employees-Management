<template>
  <div>
      <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        </div>
        <div class="row">
        <div class="card mx-auto">
            <div v-if="showMessage" class="alert alert-success mb-2" role="alert">
                {{message}}
            </div>
            <div class="card-header">
                <form class="row gy-2 gx-3 align-items-center" method="Get" action="">
                    <div class="col">
                    <input type="search" v-model="search" class="form-control" placeholder="Search">
                    </div>
                    <div class="col">
                    <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    <div class="col">
                        <select id="departement" v-model="selectedDepartment" class="form-control form-select" aria-label="Default select example">
                            <option v-for="department in departments" :key="department.id" :value="department.id">{{department.name}}</option>
                        </select>
                    </div>
                    <div class="col">
                    <router-link :to="{name:'EmployeesCreate'}" class="btn btn-primary float-right">Create</router-link>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#Id </th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Department</th>
                        <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <tr v-for="employee in employees" :key="employee.id">
                        <th scope="row">{{employee.id}}</th>
                        <td>{{employee.first_name}}</td>
                        <td>{{employee.last_name}}</td>
                        <td>{{employee.address}}</td>
                        <td>{{employee.department.name}}</td>
                        <td>
                            <router-link :to="{name:'EmployeesEdit',params:{id:employee.id}}" class="btn btn-success">Edit</router-link>                           
                            <button class="btn btn-danger " @click="deleteEmployee(employee.id)">Delete</button>
                        </td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            employees:[],
            showMessage:false,
            message:'',
            search:null,
            selectedDepartment:null,
            departments:[]
        }
    },
    watch:{
        search(){
            this.getEmployees();
        },
        selectedDepartment(){
          this.getEmployees();  
        }
    },
    created(){
        this.getEmployees();
        this.getDepartments();
    },
    methods:{
        getEmployees(){
            axios.get('/api/employees',{params:{
                search:this.search,
                department_id:this.selectedDepartment
            }}).then(res=>{
                this.employees=res.data.data;
            }).catch(error=>{
                console.log(error);
            });
        },
        deleteEmployee(id){
            axios.delete('/api/employee/'+id).then(res=>{
                this.showMessage=true;
                this.message=res.data;
                this.getEmployees();
            })
        },
        getDepartments(){
            axios.get('/api/employees/departments').then(res=>{
                this.departments=res.data;
            }).catch(error => {
                console.log(console.error)
            });
        },
    }
}
</script>

<style>

</style>