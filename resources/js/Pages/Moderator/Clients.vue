<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Enrollees</h5>
                <div class="btn-group">
                    <button
                        type="button"
                        class="btn btn-success btn-xs dropdown-toggle mr-2"
                        data-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <span>Export By</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        <a
                            class="dropdown-item"
                            href="javascript:void(0)"
                            @click="openExport()"
                            >Track Details</a
                        >
                        <a
                            class="dropdown-item"
                            href="javascript:void(0)"
                            @click="openPaymentExport()"
                            >Payment Details</a
                        >
                    </div>
                </div>
                <div class="input-group input-group-sm" style="width: 300px">
                    <input
                        type="text"
                        class="form-control"
                        v-model="filterName"
                        placeholder="Search by first name or last name"
                    />
                    <span class="input-group-append">
                        <button
                            @click="searchClientByLastName"
                            class="btn btn-info btn-flat mr-1"
                        >
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-xs ">
                            <th>Date Registered</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>School/Organization</th>
                            <th>Section</th>
                            <th>Enrolled Course</th>
                            <th>Course Status</th>
                            <th>E-mail Address</th>
                            <th>New Enrollee?</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="clients.data.length > 0">
                        <tr
                            class="text-xs "
                            v-for="client in pageClients.data"
                            :key="client.id"
                        >
                            <td class="text-left">
                                {{ client.client.created_at }}
                            </td>
                            <td>{{ client.client.first_name }}</td>
                            <td>{{ client.client.middle_name }}</td>
                            <td>{{ client.client.last_name }}</td>
                            <td>{{ client.client.school.name }}</td>
                            <td>{{ client.client.section }}</td>
                            <td>{{ client.program }}</td>
                            <td class="text-success text-bold">
                                {{ client.application_status }}
                            </td>
                            <td>{{ client.email }}</td>
                            <td>
                                <i
                                    v-if="client.returnee === 1"
                                    class="text-green text-bold"
                                    >Yes</i
                                >
                                <i
                                    v-if="client.returnee === 0"
                                    class="text-danger text-bold"
                                    >No</i
                                >
                            </td>
                            <td class="text-center">
                                <button
                                    @click="viewClientDetails(client.user_id)"
                                    class="btn btn-success btn-xs btn-flat"
                                >
                                    View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="8">No Client Registered</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-2">
                <button
                    :disabled="!pageClients.links.prev"
                    @click="prevPage()"
                    class="btn btn-primary btn-xs"
                >
                    Prev
                </button>
                <button
                    :disabled="!pageClients.links.next"
                    @click="nextPage()"
                    class="btn btn-primary btn-xs"
                >
                    Next
                </button>
            </div>
        </div>
        <div class="modal fade show" id="modal-export" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div
                        class="overlay d-flex justify-content-center align-items-center"
                        v-if="isExportLoading"
                    >
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Export Track Details</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="start-date">From</label>
                                <input
                                    v-model="form.from"
                                    type="date"
                                    class="form-control form-control-sm"
                                />
                            </div>
                            <div class="form-group col-6">
                                <label for="end-date">To</label>
                                <input
                                    v-model="form.to"
                                    type="date"
                                    class="form-control form-control-sm"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label for="school">School</label>
                                <select
                                    v-model="form.school_id"
                                    class="form-control form-control-sm"
                                >
                                    <option value="" selected>All</option>
                                    <option
                                        v-for="school in schools"
                                        :key="school.id"
                                        :value="school.id"
                                        >{{ school.name }}</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click="filterClients"
                            type="button"
                            class="btn btn-primary btn-sm btn-flat btn-block"
                        >
                            Filter
                        </button>
                        <download-excel
                            v-if="forExport.length > 0"
                            id="export-btn"
                            class="mx-1 btn btn-success btn-sm btn-flat btn-block"
                            :data="forExport"
                            :fields="fields"
                            name="HIAP Export"
                            title="HIAP Clients"
                            >Export</download-excel
                        >
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div
            class="modal fade show"
            id="modal-export-payment"
            aria-modal="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div
                        class="overlay d-flex justify-content-center align-items-center"
                        v-if="isExportLoading"
                    >
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Export Payment Details</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="start-date">From</label>
                                <input
                                    v-model="paymentForm.from"
                                    type="date"
                                    class="form-control form-control-sm"
                                />
                            </div>
                            <div class="form-group col-6">
                                <label for="end-date">To</label>
                                <input
                                    v-model="paymentForm.to"
                                    type="date"
                                    class="form-control form-control-sm"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label for="school">School</label>
                                <select
                                    v-model="paymentForm.school_id"
                                    class="form-control form-control-sm"
                                >
                                    <option value="" selected>All</option>
                                    <option
                                        v-for="school in schools"
                                        :key="school.id"
                                        :value="school.id"
                                        >{{ school.name }}</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click="filterClientsPayment"
                            type="button"
                            class="btn btn-primary btn-sm btn-flat btn-block"
                        >
                            Filter
                        </button>
                        <download-excel
                            v-if="forExportPayment.length > 0"
                            id="export-btn"
                            class="mx-1 btn btn-success btn-sm btn-flat btn-block"
                            :data="forExportPayment"
                            :fields="paymentFields"
                            name="HIAP Export"
                            title="HIAP Clients"
                            >Export</download-excel
                        >
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </moderator-layout>
</template>

<script>
import ModeratorLayout from "../../Layouts/ModeratorLayout.vue";
export default {
    props: ["clients", "schools"],
    components: {
        ModeratorLayout
    },
    data() {
        return {
            pageClients: this.clients,
            isSearchedList: false,
            form: {
                from: "",
                to: "",
                school_id: ""
            },
            paymentForm: {
                from: "",
                to: "",
                school_id: ""
            },
            isExportLoading: false,
            forExport: [],
            forExportPayment: [],
            filterName: "",
            fields: {
                "Date Registered": "client.created_at",
                "First Name": "client.first_name",
                "Middle Name": "client.middle_name",
                "Last Name": "client.last_name",
                "E-mail Address": "client.user.email",
                "Alternate Email": "client.alternate_email",
                "FB Link": "client.fb_link",
                "Contact No.": "client.contact_no",
                School: "client.school.name",
                Section: "client.section",
                "Year Level": "client.school_year",
                Course: "client.course",
                Program: "client.online_program.name",
                "Program Track": "program.description",
                "Required Hours": "hours_needed",
                "Start Date": "start_date",
                "End Date": "end_date",
                "Program Status": "application_status",
                Remarks: "''"
            },
            paymentFields: {
                "Date Registered": "client.created_at",
                "First Name": "client.first_name",
                "Middle Name": "client.middle_name",
                "Last Name": "client.last_name",
                "Email Address": "client.user.email",
                "Alternate Email": "client.alternate_email",
                "FB Link": "client.fb_link",
                "Contact No.": "client.contact_no",
                School: "client.school.name",
                Section: "client.section",
                "Year Level": "client.school_year",
                Course: "client.course",
                Program: "client.online_program.name",
                "Program Track": "track.program.name",
                "Program Status": "track.application_status",
                "Required Hrs": "track.hours_needed",
                "Start Date": "track.start_date",
                "End Date": "track.end_date",
                "Paid From": "paid_from",
                Purpose: "purpose",
                MOP: "mop",
                "Date Paid": "date_paid",
                "Amount Paid": "amount_paid",
                "Program Fee": "program_fee",
                "Is Verified": {
                    field: "isVerified",
                    callback: value => {
                        if (value) {
                            return "true";
                        } else {
                            return "false";
                        }
                    }
                },
                Remarks: "''"
            }
        };
    },
    methods: {
        viewClientDetails(userId) {
            this.$inertia.visit(`/md/client/${userId}`);
        },
        deleteClientDetails(userId) {
            this.$inertia.delete(`/deleteClientDetails/${userId}`);
        },
        prevPage() {
            if (this.isSearchedList) {
                axios.post(this.pageClients.links.prev, this.filterName).then(response => {
                    this.pageClients = response.data;
                });
            } else {
                this.$inertia.visit(this.pageClients.links.prev);
            }
        },
        nextPage() {
            if (this.isSearchedList) {
                axios.post(this.pageClients.links.next, this.filterName).then(response => {
                    this.pageClients = response.data;
                });
            } else {
                this.$inertia.visit(this.pageClients.links.next);
            }
        },
        searchClientByLastName() {
            if (this.filterName !== "") {
                let formData = new FormData();
                formData.append("search", this.filterName);
                axios
                    .post("/searchStudentByLastName", formData)
                    .then(response => {
                        this.pageClients = response.data;
                        this.isSearchedList = true;
                    });
            } else {
                toastr.error("Cannot search empty field.");
            }
        },
        openExport() {
            $("#modal-export").modal("show");
        },
        openPaymentExport() {
            $("#modal-export-payment").modal("show");
        },
        filterClients() {
            this.isExportLoading = true;
            axios.post("/filterClients", this.form).then(response => {
                this.forExport = response.data;
                this.isExportLoading = false;
            });
        },
        filterClientsPayment() {
            this.isExportLoading = true;
            axios
                .post("/filterClientsPayment", this.paymentForm)
                .then(response => {
                    this.forExportPayment = response.data;
                    this.isExportLoading = false;
                });
        }
    }
};
</script>
