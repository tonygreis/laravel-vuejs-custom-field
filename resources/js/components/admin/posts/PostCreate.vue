<template>
    <div>
        <h1>Create Post</h1>
        <div class="w-full mt-2">
            <form class=" md:w-1/2">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm">
                    <div class='w-full md:w-full px-3 m-2'>
                        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Category</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select v-model="selectedCategory" @change="onChange($event.target.value)" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                <option selected value="" disabled>choose ...</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Sub Category</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select v-model="post.category_id" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                <option selected value="" disabled>choose ...</option>
                                <option v-for="cat in subCat" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <div class="" v-if="fields.length > 0">
                            <div class="flex flex-wrap" v-for="field in fields" :key="field.id">
                                <div class="w-full" v-if="field.type === 'select'">
                                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>{{ field.name }}</label>
                                    <div class="flex-shrink w-full inline-block relative">
                                        <select v-model="post[field.id]" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                            <option selected value="" disabled>choose ...</option>
                                            <option v-for="op in field.options" :key="op.id" :value="op.id">{{ op.value }}</option>
                                        </select>
                                        <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full" v-if="field.type === 'text'">
                                    <div class="rounded-md shadow-sm">
                                        <div>
                                            <label>{{ field.name }}</label>
                                            <input type="text"
                                                   v-model="post[field.id]"
                                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                                   :placeholder="field.name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full" v-if="field.type === 'radio'">
                                    <label class="mb-4 flex items-center">
                                        <span class="mr-2">{{ field.name }}</span>
                                        <input v-model="post[field.id]" v-for="op in field.options" type="radio" :value="op.id" class="form-radio" name="remeber" id="remeber">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>Titulli</label>
                        <input type="text"
                               v-model="post.title"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                               placeholder="Titulli" />
                    </div>
                    <div class="mt-2 p-2">
                        <label>Description</label>
                     <textarea v-model="post.description" rows="3"></textarea>
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
        name: "PostCreate",
        data() {
            return {
                post: {
                    category_id: '',
                    title: '',
                    description: ''
                },
                selectedCategory: '',
                categories: [],
                fields: [],
                subCat: []
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            storeCat() {
                const data = this.post;
                axios.post('/api/admin/posts', data).then(res => {
                    console.log(res)
                }).catch(error => {
                    console.log(error)
                })
            },
            getCategories() {
                axios.get('/api/admin/categories')
                    .then(res => {
                        this.categories = res.data;
                    })
            },
            getCatFields(id) {
                axios.get('/api/admin/categories/'+ id + '/fields')
                    .then(res => {
                        this.fields = res.data.data;
                    })
            },
            getSubCat(id) {
                axios.get('/api/admin/categories/' + id + '/subs')
                    .then(res => {
                        this.subCat = res.data;
                    })
            },
            onChange(id) {
                this.getSubCat(id);
                this.getCatFields(id);
            }
        }
    }
</script>

<style scoped>

</style>
