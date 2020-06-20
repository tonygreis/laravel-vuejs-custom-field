<template>
    <div>
        <h1>Create Field</h1>
        <div class="w-full mt-2">
            <form class=" md:w-1/2">
                <div class="w-full md:w-full px-3 m-2">
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Name</label>
                        <input type="text"
                               v-model="field.name"
                               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                               placeholder="Name" />
                </div>
                <div class='w-full md:w-full px-3 m-2'>
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Type</label>
                    <div class="flex-shrink w-full inline-block relative">
                        <select v-model="field.type" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                            <option selected value="" disabled>choose ...</option>
                            <option v-for="(type, index) in types" :key="index" :value="type">{{ index}}</option>
                        </select>
                        <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-full px-3 m-2">
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Max Length</label>
                    <input type="number"
                           v-model="field.max"
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                           placeholder="Max length" />
                </div>
                <div class="w-full md:w-full px-3 m-2">
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Default</label>
                    <input type="text"
                           v-model="field.default"
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                           placeholder="Default" />
                </div>
                <div class="w-full md:w-full px-3 m-2">
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Help</label>
                    <input type="text"
                           v-model="field.help"
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                           placeholder="Help" />
                </div>
                <label class="w-full md:w-full px-3 m-2">
                    <span class="mr-2">Required</span>
                    <input v-model="field.required" type="checkbox" class="form-checkbox">
                </label>
                <label class="w-full md:w-full px-3 m-2">
                    <span class="mr-2">Active</span>
                    <input v-model="field.active" type="checkbox" class="form-checkbox">
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
        name: "Create",
        data() {
            return {
                field: {
                    name: '',
                    type: '',
                    active: false,
                    max: 255,
                    default: '',
                    help: '',
                    required: false
                },
                types: {}
            }
        },
        created() {
            this.getFieldType();
        },
        methods: {
            storeCat() {
                axios.post('/api/admin/fields', {
                    name: this.field.name,
                    type: this.field.type,
                    max: this.field.max,
                    default: this.field.default,
                    help: this.field.help,
                    required: this.field.required,
                    active: this.field.active
                }).then(res => {
                    this.$router.push({ name: 'Fields'});
                }).catch(error => {
                    console.log(error)
                })
            },
            getFieldType() {
                axios.get('/api/admin/fields/type')
                    .then(res => {
                    this.types = res.data;
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>
