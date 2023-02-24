<template>
    <div class="container">
        <div class="w-100 user-chat">
            <div class="card">
                <div class="p-4 border-bottom">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <h5 class="font-size-15 mb-1">Administrator</h5>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-circle text-success align-middle me-1"></i>
                                Active now
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="chat-conversation p-3">
                        <ul class="list-unstyled mb-0" data-simplebar="init" style="max-height: 486px">
                            <div class="simplebar-wrapper" style="margin: 0px">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: -20px; bottom: 0px">
                                        <div class="simplebar-content-wrapper" style="
                                                    height: auto;
                                                    padding-right: 20px;
                                                    padding-bottom: 0px;
                                                    overflow: hidden scroll;
                                                ">
                                            <div class="simplebar-content" style="padding: 0px"
                                                v-for="(chat, index) in chatroom_data.messages" :key="index">
                                                <li v-if="chat.sender.id != user.id">
                                                    <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">
                                                                {{ chat.sender.name }}
                                                            </div>
                                                            <p class="text-break">{{ chat.message }}</p>
                                                            <p class="chat-time mb-0">
                                                                <i class="bx bx-time-five align-middle me-1"></i>
                                                                {{ formattedTime(chat.time) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li v-if="chat.sender.id == user.id" class="right">
                                                    <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">
                                                                You
                                                            </div>
                                                            <p class="text-break">
                                                                {{ chat.message }}
                                                            </p>

                                                            <p class="chat-time mb-0">
                                                                <i class="bx bx-time-five align-middle me-1"></i>
                                                                {{ formattedTime(chat.time) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 645px"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden">
                                <div class="simplebar-scrollbar" style="
                                            transform: translate3d(0px, 0px, 0px);
                                            display: none;
                                        "></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible">
                                <div class="simplebar-scrollbar simplebar-visible" style="
                                            height: 377px;
                                            transform: translate3d(0px, 0px, 0px);
                                            display: block;
                                        "></div>
                            </div>
                        </ul>
                    </div>
                    <div class="p-3 chat-input-section">
                        <div class="row">
                            <div class="col">
                                <div id="typing-area" class="position-relative">
                                    <input type="text" id="type-area" v-model="message" @keyup="sendMessage()"
                                        placeholder="Type something..." class="form-control chat-input" />
                                    <div class="chat-input-links" id="tooltip-container">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" title="Images"><i
                                                        class="mdi mdi-file-image-outline"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" title="Add Files"><i
                                                        class="mdi mdi-file-document-outline"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button @click="sendMessage()" type="submit"
                                    class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
                                    <span class="d-none d-sm-inline-block me-2">Send</span>
                                    <i class="mdi mdi-send"></i>
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
    data() {
        return {
            user: this.userprop,
            tab: "recent-chat",
            message: "",
            query: null,
            search_result: null,
            placeholder: "Search in recent chats...",
            friends: null,
            recent_chats: [],
            query_recent_chats: [],
            query_friend_list: [],
            notifications: [],
            chatroom_data: null,
            status: [],
        };
    },
    props: {
        userprop: Object,
    },
    methods: {
        runThisUserEchoListener() {
            Echo.private(`user.${this.user.id}`)
                .listen("ReceiveMessage", (e) => {
                    // cek apakah ada di recent chats
                    const isExist = this.recent_chats.filter(
                        (recent) => recent.friend.id == e.payload.user.id
                    );

                    if (!isExist.length) {
                        this.recent_chats.unshift({
                            chat: { message: e.payload.message },
                            friend: e.payload.user,
                            unread: 1,
                        });
                    } else {
                        // put this user into the top in recent chat list
                        this.addToFirstIndexInRecentChats(
                            e.payload.user,
                            e.payload.message
                        );

                        // increment the unread property value for the badge
                        this.incrementUnreadMessages(e.payload.user.id);
                    }

                    console.log("Ini dari private channel");
                    console.log(e);
                })
                .listen("SendNotification", (e) => {
                    if (e.payload.notification.type == "friend-request") {
                        this.notifications.push({
                            notif: e.payload.notification,
                            sender: e.payload.sender,
                        });
                    }

                    if (
                        e.payload.notification.type == "friend-request-accepted"
                    ) {
                        this.notifications.push({
                            notif: e.payload.notification,
                            sender: e.payload.sender,
                        });
                    }

                    console.log("this is from sendnotification event.");
                    console.log(e);
                });
        },
        fetchAllRecentChats() {
            axios
                .get("/fetchAllRecentChats")
                .then((res) => {
                    res.data.forEach((friend) => {
                        this.recent_chats.push(friend);
                    });

                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        startChat(id) {
            if (this.chatroom_data) {
                Echo.leave(`chat.${this.chatroom_data.room_id}`);
                this.chatroom_data = null;
            }

            this.resetUnreadMessages(id);

            axios
                .post(`/chat/${id}`, {
                    currentISOtime: new Date().toISOString(),
                })
                .then((res) => {
                    this.chatroom_data = {
                        room_id: res.data.room_id,
                        user: res.data.user,
                        messages: res.data.messages,
                    };

                    if (!res.data.exist) {
                        this.recent_chats.unshift({
                            chat: {
                                room_id: res.data.room_id,
                                message: "",
                            },
                            friend: res.data.user,
                            unread: 0,
                        });
                    }
                    console.log(res);

                    Echo.join(`chat.${res.data.room_id}`)
                        .here((users) => {
                            console.log(users);
                        })
                        .joining((user) => {
                            console.log(user.name + " has joined.");
                        })
                        .leaving((user) => {
                            console.log(user.name + " has left.");
                        })
                        .listen("SendChat", (e) => {
                            this.chatroom_data.messages.push({
                                message: e.payload.message,
                                sender: e.payload.user,
                                time: e.payload.created_at,
                            });

                            this.addToFirstIndexInRecentChats(
                                e.payload.user,
                                e.payload.message
                            );

                            setTimeout(() => {
                                this.resetUnreadMessages(e.payload.user.id);
                            }, 500);

                            this.markAsRead(e.payload.id, "chat");

                            console.log(e);
                        });

                    console.log(this.chatroom_data);

                    return res;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        sendMessage() {
            if (!event.shiftKey && event.key == "Enter") {
                // UNTUK SEMENTARA
                if (this.message == "" || this.message == null) {
                    alert("Please enter message....");
                    return false;
                }

                this.chatroom_data.messages.push({
                    sender: this.user,
                    message: this.message,
                    time: new Date().toISOString(),
                });

                this.addToFirstIndexInRecentChats(
                    this.chatroom_data.user,
                    this.message
                );

                console.log(this.recent_chats);

                axios
                    .post("/sendMessage", {
                        message: this.message,
                        room_id: this.chatroom_data.room_id,
                    })
                    .then((res) => {
                        console.log(res);
                    })
                    .catch((err) => {
                        console.log(err);
                    });

                this.message = "";
            }
        },
        addToFirstIndexInRecentChats(sender, message) {
            this.recent_chats.map((recent) => {
                if (recent.friend.id == sender.id) {
                    recent.chat.message = message;
                    recent.chat.created_at = new Date().toISOString();
                    recent.chat.updated_at = new Date().toISOString();
                }
            });

            // user yang mengirim pesan
            const recentlyOpenedUser = this.recent_chats.filter(
                (recentChat) => {
                    return recentChat.friend.id == sender.id;
                }
            );

            // hilangkan sender dari daftar recent_chats
            this.recent_chats = this.recent_chats.filter((recentChat) => {
                return recentChat.friend.id != sender.id;
            });

            // tambahkan chat baru ke recent_chats di index pertama
            this.recent_chats.unshift(recentlyOpenedUser[0]);
        },
        incrementUnreadMessages(user_id) {
            /**
             * increment the number of unread messages this user has.
             * The number will be shown on the badge in the recent chat list.
             */

            this.recent_chats.map((recent) => {
                if (recent.friend.id == user_id) recent.unread++;
            });
        },
        resetUnreadMessages(user_id) {
            this.recent_chats.forEach((recent) => {
                if (recent.friend.id == user_id) recent.unread = 0;
            });
        },
        markAsRead(id, model) {
            axios
                .put("/read", {
                    target_id: id,
                    target_model: model,
                })
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });

            if (model == "notification") {
                this.notifications = this.notifications.filter(
                    (notif) => notif.notif.id != id
                );
            }
        },
        clearChat(room_id) {
            this.chatroom_data.messages = null;

            axios
                .post(`/clear`, {
                    room_id: room_id,
                    csrf_token: document
                        .querySelector("meta[name='csrf-token']")
                        .getAttribute("content"),
                })
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        deleteChatroom(room_id) {
            this.recent_chats = this.recent_chats.filter(
                (recent) => recent.chat.room_id != room_id
            );
            Echo.leave(`chat.${room_id}`);
            this.chatroom_data = null;

            axios
                .delete("/deletechatroom", {
                    data: {
                        room_id: room_id,
                        csrf_token: document
                            .querySelector("meta[name='csrf-token']")
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    this.setAlert(res.data.status);
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        deleteAllChats() {
            this.recent_chats = [];

            if (this.chatroom_data) {
                Echo.leave(`chat.${this.chatroom_data.room_id}`);
                this.chatroom_data = null;
            }

            axios
                .post("/clearall", {
                    csrf_token: document
                        .querySelector("meta[name='csrf-token']")
                        .getAttribute("content"),
                })
                .then((res) => {
                    this.setAlert(res.data.status);
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        scrollChat() {
            let element = document.getElementById("chat-area");
            element.scrollTop = element.scrollHeight;
        },
        setAlert(message) {
            this.status.push({ message });
        },
        formattedTime(currentISOtime) {
            const timestamp = new Date(currentISOtime);
            const days = ["Sun", "Mon", "Tue", "Wed", "Thru", "Fri", "Sat"];
            const months = [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ];

            const addZeroOffset = (timeObject) => {
                if (timeObject < 10) return "0" + timeObject;

                return timeObject;
            };

            const timeformat = `${days[timestamp.getDay()]}, ${months[timestamp.getMonth()]
                } ${addZeroOffset(timestamp.getDate())} | ${addZeroOffset(
                    timestamp.getHours()
                )}:${addZeroOffset(timestamp.getMinutes())}`;
            return timeformat;
        },
    },
    mounted() {
        // this.fetchAllRecentChats();
        // this.runThisUserEchoListener();
    },
    updated() {
        if (this.chatroom_data != null) {
            this.scrollChat();
        }
    },
};
</script>
