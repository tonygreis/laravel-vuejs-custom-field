<template>
    <div>
        <h1>Create template</h1>
        <div class="w-full mt-2">
            <form class=" md:w-1/2">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm">
                    <div>
                        <input type="text"
                               v-model="category.name"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                               placeholder="Category" />
                    </div>
                </div>
                <label class="mb-4 flex items-center">
                    <span class="mr-2">Active</span>
                    <input v-model="category.active" type="checkbox" class="form-checkbox" name="remeber" id="remeber" checked>
                </label>

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
                category: {
                    id: '',
                    name: '',
                    active: false
                }
            }
        },
        created() {
            this.category.id = this.$route.params.categoryId;
        },
        methods: {
            storeCat() {
                axios.post('/api/admin/categories/' + this.$route.params.categoryId + '/addSub', {
                    id: this.$route.params.categoryId,
                    name: this.category.name,
                    active: this.category.active
                }).then(res => {
                    this.$router.push({ name: 'Categories'});
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>
