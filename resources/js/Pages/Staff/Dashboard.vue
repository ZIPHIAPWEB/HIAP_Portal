<template>
    <client-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body p-0">
                            
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">My Profile</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{ user.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>School</td>
                                        <td>{{ user.school.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>{{ user.position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>{{ user.contact_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Enrolled Students</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center text-sm">
                                        <th class="text-left">First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Contact No.</th>
                                        <th>Enrolled Course(s)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="student in students" :key="student.id" class="text-center text-xs">
                                        <td class="text-left">{{student.first_name}}</td>
                                        <td>{{student.middle_name}}</td>
                                        <td>{{student.last_name}}</td>
                                        <td>{{student.contact_no}}</td>
                                        <td>{{ (student.user_program.length == 1) ? student.user_program[0]['program'].name : student.user_program.length + ' Courses' }}</td>
                                        <td>
                                            <button @click="ViewProfile(student)" class="btn btn-primary btn-xs">View</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-0">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h6 class="card-title">Profile</h6>
                              </div>
                              <div class="card-body p-0">

                              </div>
                          </div>
                          <div class="card">
                              <div class="card-header">
                                  <h6 class="card-title">Profile</h6>
                              </div>
                              <div class="card-body p-0">

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </client-layout>
</template>

<script>
    import ClientLayout from '../../Layouts/ClientLayout.vue';
    export default {
        props: ['user', 'students'],
        components: {
            ClientLayout
        },
        data () {
            return {
                selectedUser: []
            }
        },
        methods: {
            ViewProfile(user) {
                $('#modal-xl').modal('show');
                this.selectedUser = user;
                console.log(this.selectedUser);
            }
        }
    }
</script>