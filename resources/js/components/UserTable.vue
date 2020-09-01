<template>
    <div>
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
                <th scope="col">Del</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.created_at }}</td>
                <td v-on:click="deleteRowAndRefresh(user.id)" style="cursor: pointer">X</td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'UserTable',
        data() {
            return {
                users: JSON.parse(this.data),
            }
        },
        props: [
            'data',
        ],
        methods: {
            deleteRowAndRefresh(id) {
                Vue.axios.get('/admin/user/delete/' + id)
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
