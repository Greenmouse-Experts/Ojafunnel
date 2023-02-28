<template>
    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-4">
            <div class="py-4 border-bottom">
                <div class="d-flex">
                    <div class="flex-shrink-0 align-self-center me-3">
                        <!-- <img v-if(!user.photo) src="assets/images/users/avatar-1.jpg" class="avatar-xs rounded-circle" alt="" /> -->
                        <!-- <img :src="`${user.photo}`" class="avatar-xs rounded-circle" alt="" /> -->
                        <span class="avatar-xs rounded-circle" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{admin.name.charAt(0).toUpperCase()}} {{admin.name.charAt(1).toUpperCase()}}</span>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-15 mb-1">{{admin.name}}</h5>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-circle text-success align-middle me-1"></i>
                            Active
                        </p>
                    </div>
                </div>
            </div>

            <div class="chat-leftsidebar-nav">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active"
                            aria-selected="true" role="tab">
                            <i class="bx bx-chat font-size-20 d-sm-none"></i>
                            <span class="d-none d-sm-block">Chat</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane show active" id="chat" role="tabpanel">
                        <ul class="list-unstyled chat-list" data-simplebar="init" style="max-height: 410px">
                            <li v-for="(user, index) in users" :key="index" class="active">
                                <a @click="startChat(user.id)" href="javascript: void(0);">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center me-3">
                                            <i class="mdi mdi-circle font-size-10"></i>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center me-3">
                                            <span class="rounded-circle avatar-xs" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{user.first_name.charAt(0).toUpperCase()}} {{user.last_name.charAt(0).toUpperCase()}}</span>
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-truncate font-size-14 mb-1">
                                                {{user.first_name}} {{user.last_name}}
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!chatroom_data" class="w-100 user-chat">
            <div class="card startChat">
                <div class="chat-conversation p-3">
                    <h5 class="text-center" style="font-size: 2rem">Start a new chat</h5>
                </div>
            </div>
        </div>
        <div v-if="chatroom_data" class="w-100 user-chat">
            <div class="card">
                <div class="p-4 border-bottom ">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <h5 class="font-size-15 mb-1">{{ chatroom_data.user.first_name }} {{ chatroom_data.user.last_name }}</h5>
                            <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="chat-conversation p-3 chat-area" id="chat-area">
                        <ul v-for="(chat, index) in chatroom_data.messages" :key="index" class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                             <!-- FRIENDS CHAT TEMPLATE -->
                            <li class="last-chat" v-if="chat.sender.id != admin.id">
                                <div class="conversation-list">
                                    <div class="dropdown">

                                      <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                          </a>
                                      <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#">Copy</a>
                                      </div>
                                    </div>
                                    <div class="ctext-wrap">
                                        <div class="conversation-name">{{chat.sender.first_name}} {{chat.sender.last_name}}</div>
                                        <p>{{ chat.message }}</p>
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{ formattedTime(chat.time) }}</p>
                                    </div>
                                    
                                </div>
                            </li>
                            
                            <!-- YOUR CHAT TEMPLATE -->
                            <li class="right mt-3" v-if="chat.sender.id == admin.id">
                                <div class="conversation-list">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Copy</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="ctext-wrap">
                                        <div class="conversation-name">You</div>
                                        <p>
                                            {{ chat.message }}
                                        </p>

                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{ formattedTime(chat.time) }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="p-3 chat-input-section">
                        <div class="row">
                            <!-- <form method="POST" action="" @submit.prevent="sendMessage()"> -->
                                <div class="col">
                                    <div class="position-relative">
                                        <input v-model="message" @keyup="sendMessage()" type="text" class="form-control chat-input" placeholder="Enter Message...">
                                        <div class="chat-input-links" id="tooltip-container">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button @click="sendMessage()" type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      admin: this.adminprop,
      message: '',
      query: null,
      search_result: null,
      placeholder: 'Search in recent chats...',
      users: null,
      recent_chats: [],
      query_recent_chats: [],
      query_friend_list: [],
      chatroom_data: null,
      status: []
    }
  },
  props: {
    adminprop: Object
  },
  methods: {
    fetchAllUsers () {
      axios.get('/admin/page/support/get/users')
      .then((res) => {
        this.users = res.data;
        console.log(this.users);
      }).catch((err) => {
        console.log(err);
      });
    },
    fetchAllRecentChats () {
      axios.get('/chats')
      .then((res) => {
        res.data.forEach(friend => {
          this.recent_chats.push(friend);
        });

        console.log(res);
      }).catch((err) => {
        console.log(err);
      });
    },
    startChat (id) {
      if (this.chatroom_data) {
        Echo.leave(`chat.${this.chatroom_data.room_id}`);
        this.chatroom_data = null;
      }

    //   this.resetUnreadMessages(id);

      axios.post(`/admin/page/support/start/chat/${id}`, {
        currentISOtime: new Date().toISOString()
      })
      .then((res) => {
        this.chatroom_data = {
          room_id: res.data.room_id,
          user: res.data.user,
          messages: res.data.messages
        }

        if (!res.data.exist) {
          this.recent_chats.unshift({
            chat: {
              room_id: res.data.room_id,
              message: ''
            },
            friend: res.data.user,
            unread: 0
          });
        } 
        console.log(res);

        // Echo.join(`chat.${res.data.room_id}`)
        // .here((users) => {
        //   console.log(users);
        // })
        // .joining((user) => {
        //   console.log(user.name + ' has joined.');
        // })
        // .leaving((user) => {
        //   console.log(user.name + ' has left.');
        // })
        // .listen('SendChat', (e) => {
        //   this.chatroom_data.messages.push({
        //     message: e.payload.message,
        //     sender: e.payload.user,
        //     time: e.payload.created_at
        //   });

        //   this.addToFirstIndexInRecentChats(e.payload.user, e.payload.message);

        // //   setTimeout(() => {
        // //     this.resetUnreadMessages(e.payload.user.id);
        // //   }, 500);

        //   this.markAsRead(e.payload.id, 'chat');

        //   console.log(e);
        // });

        // console.log(this.chatroom_data);

        // return res;
      })
      .catch((err) => {
        console.log(err);
      });
    },
    sendMessage () {
      if (!event.shiftKey && event.key == 'Enter') {
        // UNTUK SEMENTARA
        if (this.message == '' || this.message == null) {
          alert('Please enter message!!');
          return false;
        }
  
        this.chatroom_data.messages.push({
          sender: this.user,
          message: this.message,
          time: new Date().toISOString()
        });
  
        // this.addToFirstIndexInRecentChats(this.chatroom_data.user, this.message);
  
        console.log(this.recent_chats);
  
        axios.post('/admin/page/support/send', {
          message: this.message,
          room_id: this.chatroom_data.room_id
        })
        .then((res) => {
          console.log(res);
        }).catch((err) => {
          console.log(err);        
        });
  
        this.message = '';
      }
    },
    formattedTime (currentISOtime) {
      const timestamp = new Date(currentISOtime);
      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thru', 'Fri', 'Sat'];
      const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

      const addZeroOffset = timeObject => {
        if (timeObject < 10) return '0' + timeObject;

        return timeObject;
      }

      const timeformat = `${days[timestamp.getDay()]}, ${months[timestamp.getMonth()]} ${addZeroOffset(timestamp.getDate())} | ${addZeroOffset(timestamp.getHours())}:${addZeroOffset(timestamp.getMinutes())}`;
      return timeformat;
    },
    scrollChat () {
      let element = document.getElementById('chat-area');
      element.scrollTop = element.scrollHeight;
    },
  },
  mounted () {
    this.fetchAllUsers();
    // this.fetchAllRecentChats();
  },
  updated () {
    if (this.chatroom_data != null) {
      this.scrollChat();
    }
  }
}
</script>

<style scoped>
    .startChat {
        height: 100%;
        display: flex;
        justify-content: center;
    }
    .chat-area {
        /* border: 5px solid lightseagreen; */
        overflow-y: auto;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .chat-area::-webkit-scrollbar {
        width: 0;
    }
</style>