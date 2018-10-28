<template>
   <div class="chat-app">
       <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
       <ContactsList :contacts="contactes" @selected="startConversationWith" />
   </div>
   </template>

<script>

import Conversation from './Conversation';
import ContactsList from './ContactsList';
    export default {
        props:{
            user:{
                type:Object,
                required:true
            }
        },
        data() {
            return{
                selectedContact:null,
                messages:[],
                contactes:[]
            }
        },
        mounted(){
           Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage',(e)=>
            {
                this.hanleIncoming(e.message)
            });
        
        
        
        axios.get('contacts')
            .then(response=>{
                  this.contactes=response.data;
            })
        
        
        },
        
        
        
        
        methods:{
        
        
                startConversationWith(contact){
                
                this.updateUnreadCount(contact,true);

                    axios.get(`Conversation/${contact.id}`,)
                    .then(response=>{
                        
                        this.messages=response.data;
        
                        this.selectedContact=contact;
        


                                    })
                 },
                saveNewMessage(message){
                    this.messages.push(message);

                },
                hanleIncoming(message){
                    if(this.selectedContact && this.selectedContact.id==message.from){
                        this.saveNewMessage(message);
                    }
                    this.updateUnreadCount(message.from_contact,false)

                },
                updateUnreadCount(contact,reset){
                    this.contactes=this.contactes.map((single)=>{
                        if(contact.id!=single.id) return single;

                       if(reset)
                       single.unread=0;
                       else single.unread++;

                       return single;
                    });

                    }




        },
        components:{
            ContactsList,Conversation
        }
    }
</script>
<style lang="scss" scoped>
.chat-app{
    display: flex;
}
</style>
