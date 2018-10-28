<template>
   <div class="contacts-list">

<ul>
    <li v-for="contact in sortedContacts" v-bind:key='contact.id' @click="selectContact(contact)" :class="{'selected':contact==selected}">
    <div class="avatar">
            <img src="http://localhost:8000/assets/male-user-profile.png" :alt="contact.name" >
    
    </div>
    
    <div class="contact">
        <p class="name">{{contact.name}}</p>
        <p class="email ">{{contact.email }}</p>
    </div>
         <span  class="unread" v-if="contact.unread">{{contact.unread}}</span>

    </li>
</ul>


   </div>
   </template>

<script>
    export default {
        data(){
            return{
                selected:(this.contacts.lenth>0)?this.contacts[0]:null,
            }
        },
        props:{
            contacts:{
                type:Array,
                default:[]
            }
        },

        methods:{
            selectContact(contact){
                this.selected=contact;
                this.$emit('selected',contact);
            }
        },
        computed:{
            
            sortedContacts(){
                return _.sortBy(this.contacts,[(contact)=>{
                   
                   if(this.selected==contact) return Infinity
                    
                    return contact.unread;
                
                }]).reverse();
            }
        }
       }
</script>
<style lang="scss" scoped>
.contacts-list{
    flex:2;
    max-height: 600px;
    overflow-y: scroll;
       border-left: 1px solid #c7cece;
}

            

ul{
    list-style-type: none;
    padding-left: 0px;

        li{
                display: flex;
            padding: 3px;
            border-bottom: 1px solid #d6dcde;
            position: relative;
            height: 80px;
            cursor: pointer;
                
                
                
                
                &.selected {
                        background: #bae7cd;
                                }

                        span.unread {
                            background: #fe605c;
                            position: absolute;
                            right: 11px;
                            top: 1;
                            top: 5px;
                            color: #fff;
                            display: flex;
                            font-weight: bold;
                            min-width: 21px;
                            justify-content: center;
                            align-items: center;
                            padding: 1px;
                            line-height: 16px;
                            border-radius: 50%;
                            font-size: 13px;
                                }
                
            .avatar {
                flex: 1;
                display: flex;
                align-items: center;

                    img{
                        width: 35px;
                        border-radius: 50px;
                        margin: 0 auto;
                            }
            }
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;

                    p{
                        margin: 0px;

                        &.name{
                            font-weight: bold;
                        }

                    }
                    
                     


            }



        }

}
</style>
