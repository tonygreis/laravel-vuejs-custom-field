<template>
    <div>
        <h1>Add Field</h1>
        <div class="w-full mt-2">
            <form class=" md:w-1/2">
                <div class='w-full md:w-full px-3 m-2'>
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Type</label>
                    <div class="flex-shrink w-full inline-block relative">
                        <select v-model="field" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                            <option selected value="" disabled>choose ...</option>
                            <option v-for="field in fields" :key="field.id" :value="field.id">{{ field.name }}</option>
                        </select>
                        <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" @click.prevent="storeCat" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddSub",
        data() {
            return {
                fields: [],
                field: ''
            }
        },
        created() {
            this.getFields();
        },
        methods: {
            storeCat() {
                axios.post('/api/admin/categories/' + this.$route.params.categoryId + '/fields/create', {
                    field_id: this.field,
                }).then(res => {
                    this.$router.push({ name: 'Categories'});
                }).catch(error => {
                    console.log(error)
                })
            },
            getFields() {
                axios.get('/api/admin/fields')
                    .then(res => {
                        this.fields = res.data.data;
                    })
            },
        }
    }
</script>

<style scoped>

</style>
