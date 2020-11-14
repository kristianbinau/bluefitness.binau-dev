<template>
    <div>
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Exercise</th>
                <th scope="col">Gender</th>
                <th scope="col">Date</th>
                <th scope="col">Del</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="exercise in exercises">
                <th scope="row">{{ exercise.id }}</th>
                <td>{{ exercise.name }}</td>
                <td>{{ exercise.gender }}</td>
                <td>{{ exercise.created_at }}</td>
                <td v-on:click="deleteRowAndRefresh(exercise.id, exercise.name)" style="cursor: pointer">X</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'ExerciseTable',
        data() {
            return {
                exercises: JSON.parse(this.data),
            }
        },
        props: [
            'data',
        ],
        methods: {
            deleteRowAndRefresh(id, name) {
                if (confirm('Delete ' + name + " and all of it's records?")) {
                    Vue.axios.get('/admin/exercise/delete/' + id)
                        .then((response) => {
                            console.log(response);
                            if (response.status === 200) {
                                location.reload();
                                return true;
                            }
                            else {
                                return false;
                            };
                        })
                }
                else {
                    return false;
                }
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
