  <template>
   <div class="feed" ref="feed">
<ul v-if="contact">
    <li v-for="message in messages" :class="`message${message.to==contact.id?' sent':' received'}`" :key="message.id">
        <div class="text">
            {{message.text}}
        </div>

    </li>
</ul>
    
   </div>
   </template>



<script>

export default {
        props:{
            contact:{
                type:Object
            },
            messages:{
                type:Array,
                require:true
            }
        },

        methods:{
                ScrollToBottom(){
                    setTimeout(()=>{
                this.$refs.feed.scrollTop=this.$refs.feed.scrollHeight-this.$refs.feed.clientHeight;                
                    },50);
                    
                }

                    },

            watch:{
                contact(){
                        this.ScrollToBottom();
                },

                messages(){
                        this.ScrollToBottom();

                }
            }



        
 

                            }
</script>
 <style lang="scss" scoped>
 .feed {
    max-height: 470px;
    height: 100%;
    overflow-y: scroll;
    background: #f8fafc;

    ul {
    list-style-type: none;
    padding: 5px;

        li{
            
            &.message {
            margin: 10px 0;
            width: 100%;


                .text {
                        max-width: 200px;
                        border-radius: 5px;
                        padding: 12px;
                        display: inline-block;
                        }

                &.received {
                text-align: right;

                    .text{
                        background: lightblue;

                            }
                                }
                            
                            
                &.sent {
                
                text-align: left;

                    .text{
                        background: #baffcf;

                        }
                             
                            }
                            
                            
                            
                            }
        
        }
 
                }


}


 </style>
 