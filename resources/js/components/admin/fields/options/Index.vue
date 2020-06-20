<template>
    <div>
        <div class="w-full mt-2">
            <div class="flex">
                <router-link class="p-2 bg-blue-200 rounded-lg" :to="{ name: 'FieldCreateOption', params: { fieldId: this.$route.params.fieldId }}">Add Option</router-link>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
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
                        <tr v-for="option in options" :key="option.id">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{option.value}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ option.field_id }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <router-link class="p-2 bg-blue-200 rounded-lg" :to="{ name: 'FieldEditOption', params: { fieldId: option.field_id ,optionId: option.id }}">Edit</router-link>
                                    <button type="button" class="p-2 bg-red-500 ml-2 rounded-lg" @click="destroy(option.id)">Delete</button>
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
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                options: []
            }
        },
        created() {
            this.getFields();
        },
        methods: {
            getFields() {
                axios.get('/api/admin/fields/'+ this.$route.params.fieldId + '/options')
                    .then(res => {
                        this.options = res.data.data;
                    })
            },
            destroy(id) {
                axios.delete('/api/admin/fields/'+ this.$route.params.fieldId + '/options/'+ id)
                    .then(res => {
                        this.getFields();
                    }).catch(error => {
                    console.log(error)
                })
            }

        }
    }
</script>

<style scoped>

</style>
