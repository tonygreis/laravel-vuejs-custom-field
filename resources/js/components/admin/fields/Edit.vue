<template>
    <div>
        <h1>Edit Field</h1>
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
                    <button type="submit" @click.prevent="updateField" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Update
                    </button>
                </div>
            </form>
        </div>
       <div class="container mx-auto mt-2">
           <div class="w-full" v-if="field.options.length > 0">
               <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                   <div class="flex justify-between p-2 bg-blue-200">
                       <div></div>
                       <div>Options</div>
                   </div>
                   <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                       <table class="min-w-full leading-normal">
                           <thead>
                           <tr>
                               <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Value
                               </th>
                               <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   field_id
                               </th>
                               <th
                                   class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Action
                               </th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr v-for="cat in field.options" :key="cat.id">
                               <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap">{{cat.value}}</p>
                               </td>
                               <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       {{ cat.field_id }}
                                   </p>
                               </td>
                               <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       <router-link class="p-2 bg-blue-200 rounded-lg" :to="{ name: 'FieldEditOption', params: { fieldId: cat.field_id ,optionId: cat.id }}">Edit</router-link>
                                       <button type="button" class="p-2 bg-red-500 ml-2 rounded-lg" @click="destroyOption(cat.id)">Delete</button>
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
       </div>
    </div>
</template>

<script>
    export default {
        name: "Edit",
        data() {
            return {
                field: {
                    name: '',
                    type: '',
                    active: false,
                    max: 255,
                    default: '',
                    help: '',
                    required: false,
                    options: []
                },
                types: {}
            }
        },
        created() {
            this.getField(this.$route.params.fieldId);
            this.getFieldType();
        },
        methods: {
            updateField() {
                axios.post('/api/admin/fields/'+ this.$route.params.fieldId, {
                    name: this.field.name,
                    type: this.field.type,
                    max: this.field.max,
                    default: this.field.default,
                    help: this.field.help,
                    required: this.field.required,
                    active: this.field.active,
                    _method: 'PUT',
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
            },
            getField(id) {
                axios.get('/api/admin/fields/'+ id)
                    .then(res => {
                        this.field = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            destroyOption(id) {
                axios.delete('/api/admin/fields/'+ this.$route.params.fieldId + '/options/'+ id)
                    .then(res => {
                        this.getField(this.$route.params.fieldId);
                    }).catch(error => {
                    console.log(error)
                })
            }
        }

    }
</script>

<style scoped>

</style>
