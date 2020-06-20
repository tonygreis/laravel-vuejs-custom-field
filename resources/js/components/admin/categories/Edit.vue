<template>
    <div>
        <h1>Edit template</h1>
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
                    <button type="submit" @click.prevent="updateCat" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Update
                    </button>
                </div>
            </form>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto" v-if="category.children.length > 0">
            <div class="flex justify-between p-2 bg-blue-200">
                <div></div>
                <div>Children</div>
            </div>
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Slug
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Active
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="cat in category.children" :key="cat.id">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{cat.name}}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ cat.slug }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 opacity-50 rounded-full"
                                              :class="{'bg-green-200': cat.active, 'bg-red-200': !cat.active }"></span>
                                        <span class="relative">Active</span>
                                    </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <button type="button" class="p-2 bg-blue-200 ml-2 rounded-lg" @click="editCat(cat.id)">Edit</button>
                                <button type="button" class="p-2 bg-red-500 ml-2 rounded-lg" @click="destroy(cat.id)">Delete</button>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto" v-if="category.fields.length > 0">
            <div class="flex justify-between p-2 bg-blue-200">
                <div></div>
                <div>Fields</div>
            </div>
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Type
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Active
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="field in category.fields" :key="field.id">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{field.name}}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ field.type }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 opacity-50 rounded-full"
                                              :class="{'bg-green-200': field.active, 'bg-red-200': !field.active }"></span>
                                        <span class="relative">Active</span>
                                    </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <button type="button" class="p-2 bg-blue-200 ml-2 rounded-lg" @click="editField(field.id)">Edit</button>
                                <button type="button" class="p-2 bg-red-500 ml-2 rounded-lg" @click="detachField(field.id)">Detach</button>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Edit",
        data() {
            return {
                category: {
                    name: '',
                    active: false,
                    children: []
                }
            }
        },
        created() {
            this.getCategory(this.$route.params.categoryId);
        },
        methods: {
            getCategory(id){
                axios.get('/api/admin/categories/'+ id)
                .then(res => {
                    this.category = res.data.data;
                })
            },
            updateCat(){
                axios.post('/api/admin/categories/' + this.$route.params.categoryId, {
                    name: this.category.name,
                    active: this.category.active,
                    _method: 'PUT',
                }).then(res => {
                    this.$router.push({ name: 'Categories'});
                }).catch(error => {
                    console.log(error)
                })
            },
            editCat(id) {
                this.getCategory(id);
                this.$router.push({ name: 'EditCategories', params: { categoryId: id }});
            },
            destroy(id) {
                axios.delete('/api/admin/categories/'+ id)
                    .then(res => {
                        this.$router.push({ name: 'Categories'});
                    }).catch(error => {
                    console.log(error)
                })
            },
            editField(id) {
                this.$router.push({ name: 'FieldEdit', params: { fieldId: id }});
            },
            detachField(id) {
                axios.post('/api/admin/categories/'+this.$route.params.categoryId + '/fields/detach', {
                    field_id: id
                })
                    .then(res => {
                        this.getCategory(this.$route.params.categoryId)
                    }).catch(error => {
                    console.log(error)
                })
            },
        },

    }
</script>

<style scoped>

</style>
