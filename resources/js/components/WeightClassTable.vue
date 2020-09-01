<template>
    <div>
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Weight</th>
                <th scope="col">Date</th>
                <th scope="col">Del</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="weightClass in weightClasses">
                <th scope="row">{{ weightClass.id }}</th>
                <td>{{ weightClass.name }}</td>
                <td>{{ weightClass.gender }}</td>
                <td>{{ weightClass.weight }}</td>
                <td>{{ weightClass.created_at }}</td>
                <td v-on:click="deleteRowAndRefresh(weightClass.id)" style="cursor: pointer">X</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'WeightClassTable',
        data() {
            return {
                weightClasses: JSON.parse(this.data),
            }
        },
        props: [
            'data',
        ],
        methods: {
            deleteRowAndRefresh(id) {
                Vue.axios.get('/admin/class/delete/' + id)
                    .then((response) => {
                        console.log(response);
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
