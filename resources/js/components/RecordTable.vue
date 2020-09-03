<template>
    <div>
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Exercise</th>
                <th scope="col">Weight Class</th>
                <th scope="col">Weight</th>
                <th scope="col">Date</th>
                <th scope="col">Created At</th>
                <th scope="col">Del</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="record in records">
                <th scope="row">{{ record.id }}</th>
                <td>{{ record.user['name'] }}</td>
                <td>{{ record.exercise['name'] }}</td>
                <td>{{ record.exercise_weight_class.name }}</td>
                <td>{{ record.weight }}</td>
                <td>{{ record.date }}</td>
                <td>{{ record.created_at }}</td>
                <td v-on:click="deleteRowAndRefresh(record.id)" style="cursor: pointer">X</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'RecordTable',
        data() {
            return {
                records: JSON.parse(this.data),
            }
        },
        props: [
            'data',
        ],
        methods: {
            deleteRowAndRefresh(id) {
                Vue.axios.get('/admin/record/delete/' + id)
                    .then((response) => {
                        if (response.status === 200) {
                            location.reload();
                        };
                    })
            },
        },
        beforeMount() {

        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
