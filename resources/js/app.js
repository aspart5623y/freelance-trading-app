require('./bootstrap');

import moment from 'moment'


const message_el = document.querySelector('.message-area ul');
const message_form = document.getElementById('messageForm');
const message_text = document.getElementById('messageBox');
const my_id = document.getElementById('myId');
const sender_id = document.getElementById('senderId');
const reciever_id = document.getElementById('recieverId');
const conversation_id = document.getElementById('conversationId');
const message_type = 'text';
const extension = '';


message_form.addEventListener('submit', function(e) {
    e.preventDefault();

    if (message_text.value != null) {
        const options = {
            method: 'POST',
            url: 'store',
            data: {
                conversation_id: conversation_id.value,
                message_text: message_text.value,
                sender_id: sender_id.value,
                reciever_id: reciever_id.value,
                message_type: message_type,
                extension: extension
            }
        }

        axios(options)
        message_text.value = '' 
        
    }
});


window.Echo.channel('tranzir-chat')
        .listen('.message', (e) => {
            // console.log(e);
            var message = e.message
            var newmessage = '';
            if (message.conversation_id == conversation_id.value) {
                if (message.profile_id == my_id.value) {
                    newmessage = `
                        <li class="message-div sent ms-auto bg-success text-white">
                            ${message.message_text}
                            <small class="fst-italic d-block text-end text-muted">${moment(message.created_at).format("ddd, MMM Do YYYY, h:mm a")}</small>
                        </li>
                    `
                } else {
                    newmessage = `<li class="message-div recieved me-auto bg-white">
                        ${message.message_text}
                        <small class="fst-italic d-block text-end text-muted">${moment(message.created_at).format("ddd, MMM Do YYYY, h:mm a")}</small>
                    </li>`
                }
    
                message_el.innerHTML += newmessage
                message_el.scrollTop = message_el.scrollHeight;
            }
        })