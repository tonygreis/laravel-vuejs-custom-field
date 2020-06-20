<template>
    <div>
        <h1>Create Field</h1>
        <div class="w-full mt-2">
            <form class=" md:w-1/2">
                <div class="w-full md:w-full px-3 m-2">
                    <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Name</label>
                    <input type="text"
                           v-model="option.value"
                           class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                           placeholder="Name" />
                </div>

                <div class="mt-6">
                    <button type="submit" @click.prevent="storeOption" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
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
                option: {
                    field_id: '',
                    value: '',
                },
            }
        },
        created() {
            this.option.field_id = this.$route.params.fieldId;
        },
        methods: {
            storeOption() {
                axios.post(`/api/admin/fields/`+this.$route.params.fieldId+`/options`, {
                    field_id: this.option.field_id,
                    value: this.option.value,
                }).then(res => {
                    this.$router.push({ name: 'FieldOptions', params: {'fieldId': this.$route.params.fieldId}});
                }).catch(error => {
                    console.log(error)
                })
            },
        }
    }
</script>

<style scoped>

</style>
