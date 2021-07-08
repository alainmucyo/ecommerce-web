<template>
    <div class="container">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inbox_people">
                            <div class="headind_srch">
                                <div class="srch_bar">
                                    <div class="stylish-input-group">
                                        <input type="text" class="search-bar" v-model="search"
                                               placeholder="Search">
                                        <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span></div>
                                </div>
                            </div>
                            <div class="inbox_chat">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action"
                                       v-for="chat in filteredChatList"
                                       :key="chat.id"
                                       @click.prevent="selectChat(chat.id)" :class="{'active':chat.id==selected_chat}">
                                        <div class="list-content">
                                            <img :src="chat.avatar" alt="User" class="chat-image">
                                            <div class="person-details">
                                                <div class="chat-name">{{ chat.name}}</div>
                                                <div class="chat-type">{{chat.type}}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mesgs">
                            <div class="msg_history">
                                <div v-for="message in messages" :key="message.id">
                                    <div class="incoming_msg" v-if="message.incoming">
                                        <div class="incoming_msg_img"><img
                                            :src="message.sender_avatar"
                                            alt="Avatar"></div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>{{ message.message}}</p>
                                                <span class="time_date"> {{ message.sent_at}}</span></div>
                                        </div>
                                    </div>
                                    <div class="outgoing_msg" v-if="message.outgoing">
                                        <div class="sent_msg">
                                            <p>{{ message.message}}</p>
                                            <span class="time_date"> {{ message.sent_at}}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right" v-if="sending">Sending...</div>
                            <br>
                            <div class="type_msg">
                                <div class="input_msg_write">
                                    <form action="#" @submit.prevent="sendMessage">
                                        <input type="text" v-model="form.message" class="write_msg"
                                               placeholder="Type a message"/>
                                        <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
                                                                                      aria-hidden="true"></i></button>
                                    </form>
                                </div>
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
        name: "TestChat",
        props: ["chatter_id"],
        data() {
            return {
                chatList: [],
                messages: [],
                selected_chat: null,
                sending: false,
                search: '',
                form: {
                    message: ''
                }
            }
        },
        methods: {
            loadMessages(chatter_id) {
                axios.get("/chatbox/message/" + chatter_id)
                    .then(resp => {
                        this.messages = resp.data.data;
                    })
                    .catch(err => {
                        console.log("error");
                    })
            },
            sendMessage() {
                this.$Progress.start();
                this.sending = true;
                axios.post("/chatbox/message", {message: this.form.message, receiver_id: this.selected_chat})
                    .then(resp => {
                        this.sending = false;
                        this.$Progress.finish();
                        this.messages.unshift(resp.data.data);
                        this.form.message = ""

                    })
                    .catch(err => {
                        this.sending = false;
                        console.log("error");
                        this.$Progress.fail();
                    })
            },
            selectChat(chat_id) {
                if (chat_id != null) {
                    this.selected_chat = chat_id;
                    this.loadMessages(chat_id)
                }

            },
            loadChatList() {
                this.$Progress.start();
                axios.get("/chatbox/chatlist?seller_id=" + this.chatter_id)
                    .then(resp => {
                        this.chatList = resp.data.data;
                        this.$Progress.finish();
                        if (!this.selected_chat) {
                            this.selectChat(this.chatList[0] ? this.chatList[0].id : null)
                        } else {
                            this.loadMessages(this.selected_chat)
                        }
                    })
                    .catch(err => {
                        console.log("error");
                        this.$Progress.fail()
                    })
            }
        },
        computed: {
            filteredChatList() {
                return this.chatList.filter(c => {

                    return c.name.toLowerCase().includes(this.search.toLowerCase()) || c.type.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        },
        created() {
            this.loadChatList();
            if (this.chatter_id != 0) {
                this.selected_chat = this.chatter_id
            }
        },
        mounted() {
            setInterval(() => {
                this.loadMessages(this.selected_chat)
            }, 10000)
        }
    }
</script>

<style scoped>
    .container {
        max-width: 1170px;
        margin: auto;
    }

    img {
        max-width: 100%;
    }

    .list-content {
        display: flex;
        align-items: center;
    }

    .list-group-item {
        border-radius: 0;
    }

    .list-group-item.active .person-details {
        display: flex;
        flex-direction: column;
        color: #fff;
    }

    .list-group-item .person-details {
        display: flex;
        flex-direction: column;
        color: #797979;
    }

    .chat-type {
        font-size: 70%;
        text-transform: uppercase;

    }

    .chat-image {
        height: 3rem;
        border-radius: 50%;
        margin-right: .95rem;
    }

    .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 100%;
        border-right: 1px solid #c4c4c4;
    }

    .inbox_msg {
        border-radius: 3px;
        border: solid #f6f6f6 1px;
        box-shadow: 0 3px 7px rgba(0, 0, 0, .3);
        clear: both;
        overflow: hidden;
    }


    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 100%;
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #fa812e;
        font-size: 21px;
        margin: auto;
    }

    .srch_bar input {
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 14px;
        color: #989898;
        margin: auto
    }

    .inbox_chat {
        height: 550px;
        overflow-y: auto;
    }

    .incoming_msg {
        margin: 10px 0 5px;
    }

    .incoming_msg_img {
        display: inline-block;
        width: 6%;

    }

    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }

    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received_withd_msg {
        width: 57%;
    }

    .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 100%;
    }

    .sent_msg p {
        background: #fa812e none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .outgoing_msg {
        overflow: hidden;
        /*margin: 26px 0 26px;*/
        margin: 10px 0 5px;
    }

    .sent_msg {
        float: right;
        width: 46%;
    }

    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
    }

    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }

    .msg_send_btn {
        background: #fa812e none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
    }

    .messaging {
        padding: 0 0 50px 0;
    }

    .msg_history {
        height: 516px;
        overflow-y: auto;
        display: flex;
        flex-direction: column-reverse;
    }

    input:focus, button:focus {
        outline: none;
    }
</style>
