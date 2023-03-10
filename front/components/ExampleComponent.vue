<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-role="'Admin'">
                    <div class="card-header">Puto</div>

                    <div class="card-body">
                        <button >Me ves por que soy admin</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       
        async created() {
          
            const { data: roles } = await this.$axios.get('/api/roles');

            
            this.$gates.setRoles(roles);
        }
    }
</script>