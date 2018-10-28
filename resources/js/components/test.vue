<template class="container">
    <div  class="row">
 
    <form method="POST" v-on:submit.prevent="postFile" class="col-md-12" enctype="multipart/form-data"> 
 
                
                
                
                                    
                
                <div  class="form-group row ">
                    <div class="col-md-12">
                        <label for='file' class="control-label sr-only">file</label>
            

                        <input type="file" id="file" ref="file" name="file" class="form-control "  placeholder='file' @change="chargedata">
            
                    </div>
                </div>


                 
                <input class="btn btn-primary btn-block" value="test" type="submit"  >
                

            </form>


            
         



    </div>
</template>

<script>
    export default {

        data(){
            return {
           
           attachment:null


            }
        },
       

        methods: {
               
                chargedata(e){

//                    this.attachment=e.target.files[0];
                this.attachment = this.$refs.file.files[0] ;

                    console.log(this.attachment);
                },

                
                postFile(){

                        var formData=new FormData();
                        formData.append('file', this.attachment);

               
               
               axios.post(`api/test`,formData,{
                    headers: {'Content-Type': 'multipart/form-data' }          
                            } ,   
                         
                         )

                    .then(response=>{
                            console.log(response)
                    })
                    .catch(error=>{console.log(error.response)});
                    

                }



        }
    }
</script>
