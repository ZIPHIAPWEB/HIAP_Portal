<template>
    <client-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="https://placeimg.com/480/480/any" alt="">  
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h6 class="card-title">My Profile</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td class="text-center text-bold">{{ user.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>School</td>
                                        <td class="text-center text-bold">{{ user.school.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td class="text-center text-bold">{{ user.position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td class="text-center text-bold">{{ user.contact_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
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
                                    <tr v-for="student in students.data" :key="student.id" class="text-center text-xs">
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
                        <div class="card-footer py-2">
                            <button @click="PrevList()" :disabled="!students.prev_page_url" class="btn btn-primary btn-xs">Prev</button>
                            <button @click="NextList()" :disabled="!students.next_page_url" class="btn btn-primary btn-xs">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Student Overview</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-0">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header bg-info border-0">
                                  <h6 class="card-title">Student Profile</h6>
                              </div>
                              <div class="card-body p-0">
                                  <table class="table table-hover table-bordered table-sm">
                                      <tbody>
                                          <tr>
                                              <td>First Name</td>
                                              <td class="text-center">{{selectedUser.first_name}}</td>
                                          </tr>
                                          <tr>
                                              <td>Middle Name</td>
                                              <td class="text-center">{{selectedUser.middle_name}}</td>
                                          </tr>
                                          <tr>
                                              <td>Last Name</td>
                                              <td class="text-center">{{selectedUser.last_name}}</td>
                                          </tr>
                                          <tr>
                                              <td>Address</td>
                                              <td class="text-center">{{selectedUser.address}}</td>
                                          </tr>
                                          <tr>
                                              <td>FB Link</td>
                                              <td class="text-center">{{selectedUser.fb_link}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-header bg-info">
                                  <h6 class="card-title">Enrolled Courses</h6>
                              </div>
                              <div class="card-body p-0">
                                  <table class="table table-hover table-sm">
                                      <thead>
                                          <tr class="text-center text-xs">
                                              <th class="text-left">Program</th>
                                              <th>Application Status</th>
                                              <th>Course</th>
                                              <th>Start Date</th>
                                              <th>End Date</th>
                                              <th>Hours Needed</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr v-for="course in selectedUser.user_program" :key="course.id" class="text-center text-xs">
                                              <td class="text-left">{{ course.course.name }}</td>
                                              <td class="text-center">
                                                <i class="text-red" v-if="course.application_status == 0">Newly Enrolled</i>
                                                <i class="text-green" v-else>Completed</i>
                                              </td>
                                              <td>{{ course.program.name }}</td>
                                              <td>{{ course.start_date }}</td>
                                              <td>{{ course.end_date }}</td>
                                              <td>{{ course.hours_needed }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
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
            },
            PrevList() {
                this.$inertia.visit(this.students.prev_page_url);
            },
            NextList() {
                this.$inertia.visit(this.students.next_page_url);
            }
        }
    }
</script>


<style lang="scss" scoped>
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: solid 0px gray;
        transition: border-width ease-out 250ms;
        cursor: pointer;
        &:hover {
            border-width: 3px;
        }
    }
</style>