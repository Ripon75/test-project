<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $chatData['room_name'] ?? 'Chat Room' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .chat-scroll { scroll-behavior: smooth; }
        .chat-bubble {
            max-width: 80%;
            padding: 0.75rem 1.25rem;
            border-radius: 1.25rem;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
        }
        .chat-bubble-user {
            background: #2563eb;
            color: #fff;
            border-bottom-right-radius: 0.25rem;
            align-self: flex-end;
        }
        .chat-bubble-ai {
            background: #f3f4f6;
            color: #222;
            border-bottom-left-radius: 0.25rem;
            align-self: flex-start;
        }
        .chat-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-right: 0.75rem;
        }
        .chat-message-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 0.5rem;
        }
        .chat-message-row.user {
            flex-direction: row-reverse;
        }
        .chat-message-row.ai {
            flex-direction: row;
        }
        .chat-header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .chat-main {
            flex: 1 1 0%;
            overflow-y: auto;
            padding: 2rem 0.5rem 1rem 0.5rem;
            background: #fafbfc;
        }
        .chat-input-bar {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }
        .chat-input-bar textarea {
            resize: none;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            width: 100%;
            font-size: 1rem;
            outline: none;
            transition: border 0.2s;
        }
        .chat-input-bar textarea:focus {
            border: 1.5px solid #2563eb;
        }
        .chat-send-btn {
            background: #2563eb;
            color: #fff;
            border-radius: 9999px;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-left: 0.5rem;
            transition: background 0.2s;
        }
        .chat-send-btn:disabled {
            background: #a5b4fc;
            cursor: not-allowed;
        }
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .typing-dot {
            width: 0.5rem;
            height: 0.5rem;
            background: #d1d5db;
            border-radius: 9999px;
            animation: bounce 1.2s infinite alternate;
        }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes bounce {
            to { transform: translateY(-6px); }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <div class="chat-header">
            <div class="chat-avatar" style="background: #6366f1; color: #fff;">AI</div>
            <div>
                <div class="font-semibold text-lg">AI Assistant</div>
                <div class="text-xs text-gray-500">Powered by ChatGPT</div>
            </div>
        </div>
        <!-- Main Chat Area -->
        <div id="messages-container" class="chat-main chat-scroll flex-1 flex flex-col overflow-y-auto">
            <div class="chat-messages flex flex-col w-full"></div>
        </div>
        <!-- Typing Indicator -->
        <div id="typing-indicator" class="typing-indicator px-8" style="display:none;">
            <div class="chat-avatar" style="background: #6366f1; color: #fff;">AI</div>
            <div class="flex gap-1">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
            <span class="text-xs text-gray-500 ml-2">AI is typing...</span>
        </div>
        <!-- Input Bar -->
        <div class="chat-input-bar flex items-end gap-2">
            <textarea id="message-input" rows="1" placeholder="Type your message..." class="flex-1"></textarea>
            <button id="send-button" class="chat-send-btn" disabled><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    <script>
        const textarea = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');
        const messagesContainer = document.getElementById('messages-container');
        const chatMessages = document.querySelector('.chat-messages');
        const typingIndicator = document.getElementById('typing-indicator');

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            sendButton.disabled = !this.value.trim();
        });

        $(document).ready(function() {
            function showTypingIndicator() {
                $(typingIndicator).show();
                scrollToBottom();
            }

            function hideTypingIndicator() {
                $(typingIndicator).hide();
            }

            function addMessageToChat(messageData) {
                const isUser = messageData.is_sent_by_me;
                const rowClass = isUser ? 'user' : 'ai';
                const bubbleClass = isUser ? 'chat-bubble chat-bubble-user' : 'chat-bubble chat-bubble-ai';
                const avatar = isUser
                    ? `<div class="chat-avatar" style="background:#2563eb;color:#fff;">${messageData.user_avatar || 'U'}</div>`
                    : `<div class="chat-avatar" style="background:#6366f1;color:#fff;">${messageData.user_avatar || 'AI'}</div>`;
                const timestamp = messageData.timestamp ? `<div class='text-xs text-gray-400 mt-1'>${new Date(messageData.timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>` : '';
                const messageHTML = `
                    <div class="chat-message-row ${rowClass}">
                        ${isUser ? '' : avatar}
                        <div class="${bubbleClass}">
                            <div>${messageData.message}</div>
                            ${timestamp}
                        </div>
                        ${isUser ? avatar : ''}
                    </div>
                `;
                chatMessages.insertAdjacentHTML('beforeend', messageHTML);
                scrollToBottom();
            }

            function addErrorMessage() {
                addMessageToChat({
                    user_name: 'AI Assistant',
                    user_avatar: 'AI',
                    message: 'Sorry, I\'m having trouble connecting right now. Please try again later.',
                    is_sent_by_me: false,
                    is_ai: true
                });
            }

            $('#send-button').on('click', function() {
                sendMessage();
            });

            $('#message-input').on('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            function sendMessage() {
                const message = textarea.value.trim();
                if (!message) return;
                sendButton.disabled = true;
                // Add user message immediately
                const userMessage = {
                    user_name: 'You',
                    user_avatar: 'U',
                    message: message,
                    is_sent_by_me: true,
                    is_ai: false
                };

                addMessageToChat(userMessage);

                textarea.value = '';
                textarea.style.height = 'auto';
                showTypingIndicator();
                $.ajax({
                    url: '/chat/send',
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({ message: message }),
                    success: function(data) {
                        hideTypingIndicator();
                        if (data.data) {
                            addMessageToChat(data.data);
                        } else {
                            addErrorMessage();
                        }
                        sendButton.disabled = false;
                    },
                    error: function() {
                        hideTypingIndicator();
                        addErrorMessage();
                        sendButton.disabled = false;
                    }
                });
            }
            // Hide typing indicator initially
            hideTypingIndicator();
        });
    </script>
</body>
</html>
