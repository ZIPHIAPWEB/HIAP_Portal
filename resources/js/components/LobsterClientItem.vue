<template>
    <tr class="text-center">
        <td class="text-left">{{ participant.cert_id_main }}</td>
        <td>{{ participant.full_name }}</td>
        <td>{{ participant.course }}</td>
        <td>{{ participant.hours }}</td>
        <td>{{ participant.layout.name }}</td>
        <td>
            <button @click="downloadCert(participant.id)" class="btn btn-warning btn-xs">Download</button>
            <button @click="editParticipant(participant)" class="btn btn-success btn-xs">Edit</button>
            <button @click="deleteCert(participant.id)" class="btn btn-danger btn-xs">Delete</button>
        </td>
    </tr>
</template>

<script>
export default {
    props: [
        'participant'
    ],
    methods: {
        downloadCert(id) { 
            this.$inertia.visit(`/lobsterClientCertDownload/${id}`, {
                method: 'get',
                onBefore: () => confirm('Download this cert?')
            });
        },
        editParticipant(participant) {
            this.$emit('selectedParticipant', participant);
        },
        deleteCert(id) {
            this.$inertia.delete(`/lobsterClientDeleteCert/${id}`, {
                onBefore: () => confirm('Delete this cert details?'),
                onSuccess: () => {
                    toastr.info('Cert details deleted.');
                }
            })
        }
    }
}
</script>