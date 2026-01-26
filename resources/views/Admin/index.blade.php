@extends('Admin.master')
@section('content')

<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4 mb-4">

    <!-- Total Deposits -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Total Deposits</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-primary text-white">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Deposit Investors -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Total Deposit Investors</p>
                    <h5 class="mb-0"></h5>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Total Users</p>
                    <h5 class="mb-0">
                        <a href=""></a>
                    </h5>
                </div>
                <div class="ms-auto widget-icon bg-orange text-white">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Deposits -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Weekly Deposits</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-info text-white">
                    <i class="bi bi-calendar-week"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Withdrawals -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Total Withdrawals</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-danger text-white">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Net Deposit -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Net Deposit</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-warning text-white">
                    <i class="bi bi-bank"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Commission Profit -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Commission Profit</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-secondary text-white">
                    <i class="bi bi-percent"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Net Profit -->
    <div class="col">
        <div class="card rounded-4">
            <div class="card-body d-flex align-items-center">
                <div>
                    <p class="mb-1">Admin Net Profit</p>
                    <h5 class="mb-0"> $</h5>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Chat Notifications -->
<div class="notification-area mb-3">
    <div id="chatNotification" class="chat-notification">
        <i class="fas fa-comment-dots"></i>
        <span id="notificationText">New message from user!</span>
        <button id="closeNotification" class="close-notification">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Mobile Chat Toggle -->
<div class="d-lg-none mb-3">
    <button class="btn btn-primary" id="toggleSidebar">
        <i class="fas fa-bars"></i> Chat Center
    </button>
</div>

<!-- Modern Chat System -->
<div class="chat-container-wrapper">
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="chat-sidebar" id="chatSidebar">
            <div class="sidebar-header">
                <i class="fas fa-comments"></i>
                <span class="sidebar-title">Admin Chat Center</span>
                <div class="total-unread" id="totalUnreadBadge">0</div>
                <button class="d-lg-none btn-close-sidebar" id="closeSidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search messages or users" id="searchInput">
            </div>

            <!-- Admin Quick Actions -->
            <div class="admin-actions">
                <button class="action-btn" id="refreshUsers" title="Refresh Users">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button class="action-btn" id="markAllRead" title="Mark All as Read">
                    <i class="fas fa-check-double"></i>
                </button>
                <button class="action-btn" id="clearSearch" title="Clear Search">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>

            <div class="chat-list" id="chatList">
                <!-- Dynamic user list will be loaded here -->
            </div>

            <!-- Admin Chat Summary -->
            <div class="chat-summary">
                <div class="summary-item">
                    <span>Total Conversations:</span>
                    <span id="totalConversations">0</span>
                </div>
                <div class="summary-item">
                    <span>Unread Messages:</span>
                    <span id="totalUnreadMessages">0</span>
                </div>
                <div class="summary-item">
                    <span>Active Users:</span>
                    <span id="activeUsers">0</span>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="chat-area">
            <div class="chat-header" id="chatHeader">
                <div class="chat-header-info">
                    <img src="" alt="User" class="chat-header-avatar" id="chatHeaderAvatar">
                    <div class="chat-header-details">
                        <span id="chatWith">Select a chat to start messaging</span>
                        <small id="userStatus" class="user-status">Click on a user to chat</small>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="action-icon-btn d-lg-none" id="showSidebar" title="Show Chat List">
                        <i class="fas fa-list"></i>
                        <span class="mobile-unread-indicator" id="mobileUnreadIndicator"></span>
                    </button>

                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="empty-chat">
                    <i class="fas fa-comment-dots"></i>
                    <h3>Welcome to Admin Chat Center</h3>
                    <p>Select a user conversation to start messaging</p>
                    <small>You can communicate with all registered users here</small>
                </div>
            </div>

            <div class="chat-input">
                @csrf
                <div class="input-container">
                    <div class="input-actions">
                        <button class="input-action-btn" id="emojiBtn" title="Add Emoji">
                            <i class="fas fa-smile"></i>
                        </button>
                        <button class="input-action-btn" id="attachBtn" title="Attach File">
                            <i class="fas fa-paperclip"></i>
                        </button>
                    </div>
                    <textarea id="chatInput" class="chat-textarea" placeholder="Select a user first to start messaging..." rows="1" disabled></textarea>
                    <div class="send-actions">
                        <button id="sendBtn" class="send-btn" disabled>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                <div class="typing-indicator" id="typingIndicator">
                    <span></span> is typing...
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.chat-container-wrapper {
    margin-top: 20px;
}

.chat-container {
    display: flex;
    height: 700px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
}

/* Chat Notification Styles */
.notification-area {
    position: relative;
}

.chat-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 10000;
    transform: translateX(400px);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    max-width: 300px;
}

.chat-notification.show {
    transform: translateX(0);
    opacity: 1;
}

.chat-notification.hide {
    transform: translateX(400px);
    opacity: 0;
}

.close-notification {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
    margin-left: 10px;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.close-notification:hover {
    opacity: 1;
}

/* Enhanced Sidebar */
.chat-sidebar {
    width: 380px;
    background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    position: relative;
    min-width: 0;
    z-index: 1001;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar-header {
    padding: 25px 20px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
    flex-shrink: 0;
}

.sidebar-title {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
}

.btn-close-sidebar {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 8px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: none;
    font-size: 16px;
}

.btn-close-sidebar:hover {
    background: rgba(255, 255, 255, 0.2);
}

.total-unread {
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    flex-shrink: 0;
}

/* Mobile Unread Indicator */
.mobile-unread-indicator {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    display: none;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    border: 2px solid white;
}

.search-box {
    padding: 15px 20px;
    background: white;
    border-bottom: 1px solid #e2e8f0;
    position: relative;
    flex-shrink: 0;
}

.search-input {
    width: 100%;
    padding: 12px 15px 12px 40px;
    border: 1px solid #e2e8f0;
    border-radius: 25px;
    font-size: 14px;
    background: #f8fafc;
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
}

.search-box::before {
    content: '\f002';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    left: 35px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
}

/* Admin Actions */
.admin-actions {
    display: flex;
    gap: 5px;
    padding: 10px 20px;
    background: rgba(79, 172, 254, 0.1);
    border-bottom: 1px solid #e2e8f0;
    flex-shrink: 0;
}

.action-btn {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
    flex: 1;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 172, 254, 0.4);
}

.chat-list {
    flex: 1;
    overflow-y: auto;
    padding: 10px 0;
    min-height: 0;
}

.no-users-message {
    padding: 40px 20px;
    text-align: center;
    color: #64748b;
}

.no-users-message i {
    font-size: 48px;
    opacity: 0.3;
    margin-bottom: 15px;
    display: block;
}

.chat-user {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
    position: relative;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    min-height: 70px;
}

.chat-user:hover {
    background: rgba(79, 172, 254, 0.1);
    border-left-color: #4facfe;
}

.chat-user.active {
    background: linear-gradient(90deg, rgba(79, 172, 254, 0.15) 0%, rgba(0, 242, 254, 0.1) 100%);
    border-left-color: #4facfe;
}

.chat-user.has-unread {
    background: rgba(255, 71, 87, 0.1);
    border-left-color: #ff4757;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
    border: 3px solid #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info {
    flex: 1;
    overflow: hidden;
    min-width: 0;
}

.user-name {
    font-weight: 600;
    font-size: 15px;
    color: #1e293b;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-role {
    background: #4facfe;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    font-weight: 500;
    flex-shrink: 0;
}

.user-last-msg {
    font-size: 13px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
}

.unread-count {
    position: absolute;
    top: 10px;
    right: 15px;
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: bold;
    flex-shrink: 0;
}

.online-indicator {
    width: 12px;
    height: 12px;
    background: #10b981;
    border: 2px solid white;
    border-radius: 50%;
    position: absolute;
    bottom: 2px;
    right: 2px;
    animation: pulse 2s infinite;
}

.message-time-indicator {
    font-size: 11px;
    color: #94a3b8;
    position: absolute;
    bottom: 10px;
    right: 15px;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Chat Summary */
.chat-summary {
    padding: 15px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    flex-shrink: 0;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 13px;
}

.summary-item:last-child {
    margin-bottom: 0;
}

/* Enhanced Chat Area */
.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    min-width: 0;
}

.chat-header {
    padding: 25px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 1;
    min-width: 0;
}

.chat-header-details {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 0;
}

.chat-header-details span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-status {
    color: rgba(255, 255, 255, 0.8);
    font-size: 12px;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat-header-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    object-fit: cover;
    flex-shrink: 0;
}

.chat-actions {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
}

.action-icon-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
}

.action-icon-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px 30px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23f1f5f9" opacity="0.5"/><circle cx="75" cy="75" r="1" fill="%23f1f5f9" opacity="0.3"/><circle cx="50" cy="10" r="1" fill="%23f1f5f9" opacity="0.4"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    min-height: 0;
}

.message {
    margin-bottom: 20px;
    display: flex;
    align-items: flex-end;
    animation: slideInMessage 0.3s ease;
    max-width: 100%;
}

@keyframes slideInMessage {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message.admin {
    justify-content: flex-end;
}

.message-bubble {
    max-width: 70%;
    padding: 15px 20px;
    border-radius: 25px;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
}

.message.admin .message-bubble {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    border-bottom-right-radius: 8px;
}

.message.admin .message-bubble::after {
    content: '✓✓';
    font-size: 10px;
    opacity: 0.7;
    margin-left: 8px;
}

.message.user .message-bubble {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom-left-radius: 8px;
    margin-left: 15px;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    flex-shrink: 0;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
    margin-top: 8px;
    display: block;
}

.message-text {
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Enhanced Chat Input */
.chat-input {
    padding: 20px 30px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.input-container {
    display: flex;
    align-items: flex-end;
    gap: 15px;
    background: white;
    border-radius: 25px;
    padding: 15px 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.input-actions {
    display: flex;
    gap: 5px;
    flex-shrink: 0;
}

.input-action-btn {
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.input-action-btn:hover {
    background: #f1f5f9;
    color: #4facfe;
}

.chat-textarea {
    flex: 1;
    border: none;
    outline: none;
    resize: none;
    font-size: 14px;
    line-height: 1.4;
    max-height: 100px;
    min-height: 20px;
    font-family: inherit;
    margin: 0 10px;
    min-width: 0;
}

.chat-textarea:disabled {
    background: transparent;
    color: #94a3b8;
}

.send-actions {
    display: flex;
    align-items: center;
    gap: 5px;
    flex-shrink: 0;
}

.send-btn {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(79, 172, 254, 0.3);
    flex-shrink: 0;
}

.send-btn:hover:not(:disabled) {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
}

.send-btn:disabled {
    opacity: 0.5;
    transform: none;
    cursor: not-allowed;
    background: #94a3b8;
    box-shadow: none;
}

.typing-indicator {
    font-size: 12px;
    color: #64748b;
    padding: 5px 15px;
    display: none;
    font-style: italic;
}

/* Empty State */
.empty-chat {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #64748b;
    text-align: center;
    padding: 20px;
}

.empty-chat i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.3;
}

/* Custom Scrollbar */
.chat-list::-webkit-scrollbar,
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-list::-webkit-scrollbar-track,
.chat-messages::-webkit-scrollbar-track {
    background: transparent;
}

.chat-list::-webkit-scrollbar-thumb,
.chat-messages::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
}

.chat-list::-webkit-scrollbar-thumb:hover,
.chat-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.3);
}

/* Responsive Design - Mobile First Approach */
@media (max-width: 1200px) {
    .chat-sidebar {
        width: 320px;
    }

    .chat-header {
        padding: 20px 25px;
    }

    .chat-messages {
        padding: 15px 25px;
    }

    .chat-input {
        padding: 15px 25px;
    }

    .message-bubble {
        max-width: 85%;
        padding: 12px 16px;
    }

    .input-container {
        padding: 12px 15px;
        gap: 10px;
    }

    .send-btn {
        width: 40px;
        height: 40px;
    }
}

/* IMPROVED MOBILE STYLES - No Modal System */
@media (max-width: 768px) {
    .chat-container-wrapper {
        margin-top: 10px;
        margin-left: -30px;
    }

    .chat-container {
        height: 85vh;
        border-radius: 15px;
        margin: 10px;
        overflow: visible;
    }

    /* Mobile Sidebar - Slide Animation Without Modal */
    .chat-sidebar {
        width: 85vw;
        max-width: 350px;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 9999;
        transform: translateX(-100%);
        height: 100vh;
        background: #ffffff;
        border-right: none;
        box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
        border-radius: 0 20px 20px 0;
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .chat-sidebar.show {
        transform: translateX(0);
    }

    /* Chat Area Adjustments for Mobile */
    .chat-area {
        width: 100%;
        z-index: 1;
    }

    /* When sidebar is open, push chat area slightly */
    .chat-container.sidebar-open .chat-area {
        transform: translateX(20px);
        transition: transform 0.3s ease;
        opacity: 0.7;
        pointer-events: none;
    }

    .btn-close-sidebar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
    }

    .sidebar-header {
        padding: 20px;
        font-size: 16px;
        border-radius: 0 20px 0 0;
    }

    .sidebar-title {
        font-size: 16px;
    }

    .chat-header {
        padding: 20px;
        font-size: 14px;
    }

    .chat-messages {
        padding: 15px 20px;
    }

    .chat-input {
        padding: 15px 20px;
    }

    .message-bubble {
        max-width: 90%;
        padding: 10px 14px;
        font-size: 14px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .chat-user {
        padding: 12px 15px;
        min-height: 65px;
    }

    .user-name {
        font-size: 14px;
    }

    .user-last-msg {
        font-size: 12px;
    }

    .unread-count {
        width: 18px;
        height: 18px;
        font-size: 10px;
        top: 8px;
        right: 12px;
    }

    .message-time-indicator {
        font-size: 10px;
        bottom: 8px;
        right: 12px;
    }

    /* Enhanced touch interactions for mobile */
    .chat-user {
        -webkit-tap-highlight-color: transparent;
        tap-highlight-color: transparent;
    }

    .chat-user:active {
        background: rgba(79, 172, 254, 0.2);
        transform: scale(0.98);
    }

    /* Mobile unread indicator visible */
    .mobile-unread-indicator {
        display: flex;
    }

    #mobileTotalUnread {
        display: inline-block !important;
    }

    /* Improved mobile touch targets */
    .action-icon-btn {
        min-height: 44px;
        min-width: 44px;
    }

    .input-action-btn {
        min-height: 44px;
        min-width: 44px;
    }

    .send-btn {
        min-height: 44px;
        min-width: 44px;
    }
}

@media (max-width: 480px) {
    .chat-container {
        height: 90vh;
        margin: 5px;
        border-radius: 10px;
    }

    .chat-sidebar {
        width: 95vw;
        max-width: none;
        border-radius: 0 15px 15px 0;
    }

    .sidebar-header {
        padding: 15px;
        font-size: 15px;
    }

    .total-unread {
        width: 22px;
        height: 22px;
        font-size: 11px;
    }

    .chat-header {
        padding: 15px;
    }

    .chat-header-avatar {
        width: 35px;
        height: 35px;
    }

    .action-icon-btn {
        width: 30px;
        height: 30px;
        font-size: 12px;
        min-width: 44px;
        min-height: 44px;
    }

    .chat-messages {
        padding: 10px 15px;
    }

    .chat-input {
        padding: 10px 15px;
    }

    .input-container {
        padding: 10px 12px;
        border-radius: 20px;
    }

    .send-btn {
        width: 35px;
        height: 35px;
        min-width: 44px;
        min-height: 44px;
    }

    .message-bubble {
        max-width: 90%;
        padding: 8px 12px;
        font-size: 13px;
    }

    .chat-user {
        padding: 10px 12px;
        min-height: 60px;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        margin-right: 8px;
    }

    .user-name {
        font-size: 13px;
    }

    .user-last-msg {
        font-size: 11px;
    }
}

/* Animation Classes */
@keyframes slideInFromTop {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.slide-in-top {
    animation: slideInFromTop 0.5s ease-out;
}

@keyframes bounce {
    0%, 20%, 60%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    80% {
        transform: translateY(-5px);
    }
}

.bounce-animation {
    animation: bounce 2s ease-in-out;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.spinner {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #4facfe;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
    margin: 0 auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Accessibility Improvements */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .chat-container {
        background: rgba(17, 24, 39, 0.95);
        color: #f9fafb;
    }

    .chat-sidebar {
        background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
    }

    .search-input {
        background: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .chat-area {
        background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
    }

    .input-container {
        background: #374151;
        border-color: #4b5563;
    }

    .chat-textarea {
        background: transparent;
        color: #f9fafb;
    }

    .chat-textarea::placeholder {
        color: #9ca3af;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .chat-user:hover,
    .chat-user.active {
        border: 2px solid #000;
    }

    .message-bubble {
        border: 1px solid rgba(0,0,0,0.2);
    }

    .send-btn {
        border: 2px solid #000;
    }
}
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let receiverId = null;
let selectedUserName = '';
let selectedUserAvatar = '';
let lastMessageCount = 0;
let unreadMessages = {};
let notificationSound = null;
let isAdminTyping = false;
let lastSeenMessages = {};
let sidebarState = 'closed'; // Track sidebar state

// Initialize notification sound
function initializeNotificationSound() {
    try {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        notificationSound = {
            play: function() {
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);

                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            }
        };
    } catch (e) {
        console.log('Audio context not available');
    }
}

// Improved mobile sidebar controls - No Modal System
function showSidebar() {
    if (sidebarState === 'opening' || sidebarState === 'open') return;

    sidebarState = 'opening';
    $('#chatSidebar').addClass('show');
    $('.chat-container').addClass('sidebar-open');

    setTimeout(() => {
        sidebarState = 'open';
    }, 300);
}

function hideSidebar() {
    if (sidebarState === 'closing' || sidebarState === 'closed') return;

    sidebarState = 'closing';
    $('#chatSidebar').removeClass('show');
    $('.chat-container').removeClass('sidebar-open');

    setTimeout(() => {
        sidebarState = 'closed';
    }, 300);
}

// Mobile toggle events - Clean Implementation
$('#toggleSidebar, #showSidebar').off('click').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    if (sidebarState === 'closed' || sidebarState === 'closing') {
        showSidebar();
    }
});

$('#closeSidebar').off('click').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    hideSidebar();
});

// Close sidebar when clicking on chat area (mobile)
$('.chat-area').off('click').on('click', function(e) {
    if (window.innerWidth <= 768 && sidebarState === 'open') {
        hideSidebar();
    }
});

// Prevent sidebar close on content click
$('#chatSidebar').off('click').on('click', function(e) {
    e.stopPropagation();
});

// Show notification
function showNotification(message, userName) {
    const notification = $('#chatNotification');
    const truncatedMessage = message.length > 50 ? message.substring(0, 50) + '...' : message;
    $('#notificationText').text(`New message from ${userName}: ${truncatedMessage}`);

    notification.removeClass('hide').addClass('show');

    // Play sound
    if (notificationSound) {
        try {
            notificationSound.play();
        } catch (e) {
            console.log('Could not play notification sound');
        }
    }

    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification();
    }, 5000);
}

// Hide notification
function hideNotification() {
    $('#chatNotification').removeClass('show').addClass('hide');
}

// Close notification manually
$('#closeNotification').off('click').on('click', hideNotification);

// Enhanced load sidebar users with unread count management
function loadUserList(){
    $.get("{{ route('chat.users') }}", function(users){
        let html = '';
        let totalUnread = 0;
        let activeUserCount = 0;

        if(users.length === 0) {
            html = `
                <div class="no-users-message slide-in-top">
                    <i class="fas fa-users"></i>
                    <p>No user conversations yet</p>
                    <small>Users will appear here when they start chatting with admin</small>
                </div>`;
        } else {
            users.forEach(u => {
                let avatar = u.photo ? u.photo : `https://i.pravatar.cc/50?img=${u.id}`;

                let unreadCount = u.unread_count || 0;

                if (receiverId == u.id) {
                    unreadCount = 0;
                    markMessagesAsRead(u.id);
                }

                let hasUnread = unreadCount > 0;
                let isOnline = u.is_online || Math.random() > 0.7;
                let lastSeen = u.last_seen || new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                if (hasUnread) {
                    totalUnread += unreadCount;
                }

                if (isOnline) {
                    activeUserCount++;
                }

                html += `
                    <div class="chat-user ${hasUnread ? 'has-unread' : ''} ${receiverId == u.id ? 'active' : ''}" data-id="${u.id}" data-name="${u.name}" data-avatar="${avatar}">
                        <div class="user-avatar">
                            <img src="${avatar}" alt="${u.name}" loading="lazy">
                            ${isOnline ? '<div class="online-indicator"></div>' : ''}
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                ${u.name}
                                <span class="user-role">User</span>
                            </div>
                            <div class="user-last-msg">${u.last_msg || 'No messages yet'}</div>
                        </div>
                        ${hasUnread ? `<div class="unread-count">${unreadCount > 99 ? '99+' : unreadCount}</div>` : ''}
                        <div class="message-time-indicator">${lastSeen}</div>
                    </div>`;
            });
        }

        $('#chatList').html(html);

        // Update summary and mobile indicators
        $('#totalConversations').text(users.length);
        $('#totalUnreadMessages').text(totalUnread);
        $('#activeUsers').text(activeUserCount);
        $('#totalUnreadBadge').text(totalUnread > 99 ? '99+' : totalUnread);

        // Update mobile unread indicators
        if (totalUnread > 0) {
            $('#mobileTotalUnread').removeClass('d-none').text(totalUnread > 99 ? '99+' : totalUnread);
            $('#mobileUnreadIndicator').show().text(totalUnread > 99 ? '99+' : totalUnread);
        } else {
            $('#mobileTotalUnread').addClass('d-none');
            $('#mobileUnreadIndicator').hide();
        }

        // Enhanced user click handling with improved mobile UX
        $('.chat-user').off('click').on('click', function(e){
            e.preventDefault();
            e.stopPropagation();

            if ($(this).hasClass('clicking')) return;
            $(this).addClass('clicking');
            setTimeout(() => $(this).removeClass('clicking'), 300);

            $('.chat-user').removeClass('active');
            $(this).addClass('active');

            receiverId = $(this).data('id');
            selectedUserName = $(this).data('name');
            selectedUserAvatar = $(this).data('avatar');

            $('#chatWith').text(`${selectedUserName}`);
            $('#userStatus').text('Online • Click to view profile');
            $('#chatHeaderAvatar').attr('src', selectedUserAvatar);

            $(this).removeClass('has-unread').find('.unread-count').remove();
            markMessagesAsRead(receiverId);

            $('#chatInput').prop('disabled', false).attr('placeholder', `Type your message to ${selectedUserName}...`);
            $('#sendBtn').prop('disabled', false);

            // Auto-hide sidebar on mobile after selection with smooth animation
            if (window.innerWidth <= 768) {
                setTimeout(() => {
                    hideSidebar();
                }, 200);
            }

            fetchMessages();
        });
    }).fail(function() {
        console.error('Failed to load users');
        $('#chatList').html('<div style="padding: 20px; text-align: center; color: #64748b;">Failed to load users. Please refresh.</div>');
    });
}

// Rest of the JavaScript remains the same...
function markMessagesAsRead(userId) {
    if (!userId) return;

    $.post("", {
        _token: '{{ csrf_token() }}',
        user_id: userId
    }).done(function(response) {
        unreadMessages[userId] = 0;
    }).fail(function() {
        console.log('Failed to mark messages as read');
    });
}

function fetchMessages(){
    if(!receiverId) return;

    $.get("{{ route('chat.fetch') }}", {receiver_id: receiverId}, function(data){
        let chatBox = $('#chatMessages');
        let currentScrollPos = chatBox.scrollTop();
        let shouldScrollToBottom = (currentScrollPos + chatBox.outerHeight() >= chatBox[0].scrollHeight - 50);

        chatBox.html('');

        if(data.length === 0) {
            chatBox.html(`
                <div class="empty-chat">
                    <i class="fas fa-comment-dots"></i>
                    <h3>No messages yet with ${selectedUserName}</h3>
                    <p>Start the conversation!</p>
                    <small>As an admin, you can initiate conversations with any user</small>
                </div>
            `);
            return;
        }

        let newMessagesCount = 0;
        let lastUserMessageCount = lastSeenMessages[receiverId] || 0;

        if (data.length > lastUserMessageCount) {
            newMessagesCount = data.length - lastUserMessageCount;

            let newUserMessages = data.slice(lastUserMessageCount).filter(msg => msg.sender_id != {{ Auth::id() }});

            if (newUserMessages.length > 0) {
                newUserMessages.forEach(msg => {
                    if (receiverId != msg.sender_id || document.hidden) {
                        showNotification(msg.message, selectedUserName);
                    }
                });
            }
        }

        lastSeenMessages[receiverId] = data.length;

        data.forEach(msg => {
            let isAdmin = msg.sender_id == {{ Auth::id() }};
            let cls = isAdmin ? 'admin' : 'user';
            let senderName = isAdmin ? 'Admin (You)' : selectedUserName;
            let avatar = isAdmin ? 'https://i.pravatar.cc/32?img={{ Auth::id() }}' : selectedUserAvatar;

            let messageHtml = `
                <div class="message ${cls}">
                    ${!isAdmin ? `<img src="${avatar}" alt="Avatar" class="message-avatar" loading="lazy">` : ''}
                    <div class="message-bubble">
                        <div class="message-text">${escapeHtml(msg.message)}</div>
                        <small class="message-time">${formatTime(msg.created_at)} • ${senderName}</small>
                    </div>
                </div>`;
            chatBox.append(messageHtml);
        });

        if (shouldScrollToBottom || newMessagesCount > 0) {
            chatBox.scrollTop(chatBox[0].scrollHeight);
        }

    }).fail(function() {
        console.error('Failed to fetch messages');
        $('#chatMessages').html('<div style="padding: 20px; text-align: center; color: #ff4757;">Failed to load messages. Please try again.</div>');
    });
}

function sendMessage() {
    let message = $('#chatInput').val().trim();

    if(message === '') {
        return;
    }

    if(!receiverId) {
        showErrorMessage('Please select a user first to send a message');
        return;
    }

    $('#typingIndicator').show().find('span').text('Admin');
    $('#sendBtn').prop('disabled', true).addClass('loading');

    $.post("{{ route('chat.send') }}", {
        _token: '{{ csrf_token() }}',
        message: message,
        receiver_id: receiverId
    }, function(response){
        $('#chatInput').val('');
        $('#typingIndicator').hide();
        resetTextareaHeight();
        fetchMessages();
        loadUserList();
        showSuccessMessage('Message sent successfully!');
    }).fail(function(xhr) {
        $('#typingIndicator').hide();
        console.error('Failed to send message');
        let errorMsg = xhr.responseJSON?.message || 'Failed to send message. Please try again.';
        showErrorMessage(errorMsg);
    }).always(function() {
        $('#sendBtn').removeClass('loading').prop('disabled', false);
    });
}

function showSuccessMessage(message) {
    const successDiv = $(`
        <div class="alert alert-success" style="position: fixed; top: 80px; right: 20px; z-index: 9999; border-radius: 10px; max-width: 300px; animation: slideInFromTop 0.3s ease;">
            <i class="fas fa-check-circle"></i> ${message}
        </div>
    `);
    $('body').append(successDiv);
    setTimeout(() => {
        successDiv.fadeOut(() => successDiv.remove());
    }, 3000);
}

function showErrorMessage(message) {
    const errorDiv = $(`
        <div class="alert alert-danger" style="position: fixed; top: 80px; right: 20px; z-index: 9999; border-radius: 10px; max-width: 300px; animation: slideInFromTop 0.3s ease;">
            <i class="fas fa-exclamation-circle"></i> ${message}
        </div>
    `);
    $('body').append(errorDiv);
    setTimeout(() => {
        errorDiv.fadeOut(() => errorDiv.remove());
    }, 4000);
}

// Admin action buttons and other functions remain the same...
$('#refreshUsers').on('click', function() {
    $(this).addClass('bounce-animation');
    loadUserList();
    setTimeout(() => {
        $(this).removeClass('bounce-animation');
    }, 2000);
});

$('#markAllRead').on('click', function() {
    $.post("", {
        _token: '{{ csrf_token() }}'
    }).done(function() {
        unreadMessages = {};
        loadUserList();
        showSuccessMessage('All messages marked as read!');
    }).fail(function() {
        showErrorMessage('Failed to mark all as read');
    });
});

$('#clearSearch').on('click', function() {
    $('#searchInput').val('');
    $('.chat-user').show();
    $('.no-search-results').remove();
});

$('#clearChat').on('click', function() {
    if (!receiverId) {
        showErrorMessage('Please select a user first');
        return;
    }

    if (confirm('Are you sure you want to clear this chat history? This action cannot be undone.')) {
        $.post("", {
            _token: '{{ csrf_token() }}',
            user_id: receiverId
        }).done(function() {
            $('#chatMessages').html(`
                <div class="empty-chat">
                    <i class="fas fa-broom"></i>
                    <h3>Chat Cleared</h3>
                    <p>Chat history has been cleared</p>
                </div>
            `);
            showSuccessMessage('Chat history cleared!');
            loadUserList();
        }).fail(function() {
            showErrorMessage('Failed to clear chat');
        });
    }
});

$('#userProfile').on('click', function() {
    if (receiverId) {
        showSuccessMessage(`Viewing profile for ${selectedUserName}`);
        window.open(`/admin/user/profile/${receiverId}`, '_blank');
    } else {
        showErrorMessage('Please select a user first');
    }
});

$('#chatSettings').on('click', function() {
    showSuccessMessage('Chat settings opened');
});

$('#emojiBtn').on('click', function() {
    let emojis = ['😊', '👍', '❤️', '😂', '🎉', '👋', '🔥', '💯', '✨', '👏'];
    let randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
    let currentText = $('#chatInput').val();
    $('#chatInput').val(currentText + randomEmoji + ' ');
    $('#chatInput').trigger('input').focus();
});

$('#attachBtn').on('click', function() {
    showSuccessMessage('File attachment feature coming soon!');
});

$('#sendBtn').off('click').on('click', function(){
    if(!$(this).prop('disabled') && !$(this).hasClass('loading')) {
        sendMessage();
    }
});

$('#chatInput').off('keypress').on('keypress', function(e){
    if(e.which == 13 && !e.shiftKey){
        e.preventDefault();
        if(!$(this).prop('disabled') && receiverId && $(this).val().trim() !== '' && !$('#sendBtn').hasClass('loading')) {
            sendMessage();
        }
    }
});

let typingTimer;
$('#chatInput').off('input').on('input', function(){
    if($(this).prop('disabled')) return;

    const hasContent = $(this).val().trim() !== '';
    const hasReceiver = receiverId !== null;
    $('#sendBtn').prop('disabled', !(hasContent && hasReceiver));

    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 100) + 'px';

    if (hasContent && hasReceiver && !isAdminTyping) {
        isAdminTyping = true;
        $.post("", {
            _token: '{{ csrf_token() }}',
            receiver_id: receiverId,
            typing: true
        });
    }

    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
        isAdminTyping = false;
        if (hasReceiver) {
            $.post("", {
                _token: '{{ csrf_token() }}',
                receiver_id: receiverId,
                typing: false
            });
        }
    }, 1000);
});

$('#searchInput').off('input').on('input', function() {
    const searchTerm = $(this).val().toLowerCase();
    let visibleCount = 0;

    $('.chat-user').each(function() {
        const userName = $(this).find('.user-name').text().toLowerCase();
        const lastMsg = $(this).find('.user-last-msg').text().toLowerCase();

        if (userName.includes(searchTerm) || lastMsg.includes(searchTerm) || searchTerm === '') {
            $(this).show();
            visibleCount++;
        } else {
            $(this).hide();
        }
    });

    $('.no-search-results').remove();
    if (searchTerm && visibleCount === 0) {
        $('#chatList').append(`
            <div class="no-search-results" style="padding: 20px; text-align: center; color: #64748b;">
                <i class="fas fa-search"></i>
                <p>No users found for "${searchTerm}"</p>
                <small>Try a different search term</small>
            </div>
        `);
    }
});

function resetTextareaHeight() {
    const textarea = $('#chatInput')[0];
    textarea.style.height = 'auto';
    textarea.style.height = '20px';
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatTime(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays === 1) {
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else if (diffDays <= 7) {
        return date.toLocaleDateString([], { weekday: 'short' }) + ' ' +
               date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else {
        return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
    }
}

$(window).on('resize', function() {
    if (window.innerWidth > 768) {
        hideSidebar();
        sidebarState = 'closed';
    }
});

setInterval(function() {
    if(receiverId && !document.hidden) {
        fetchMessages();
    }
}, 3000);

setInterval(function() {
    if (!document.hidden) {
        loadUserList();
    }
}, 10000);

$(document).ready(function() {
    initializeNotificationSound();
    loadUserList();
    sidebarState = 'closed';

    setTimeout(() => {
        showSuccessMessage('Welcome to Admin Chat Center!');
    }, 1000);

    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                console.log('Notification permission granted');
            }
        });
    }
});

document.addEventListener('visibilitychange', function() {
    if (!document.hidden && receiverId) {
        fetchMessages();
        loadUserList();
    }
});

$(document).on('keydown', function(e) {
    if (e.which === 27 && sidebarState === 'open') {
        hideSidebar();
    }
});

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

let ticking = false;
function requestTick() {
    if (!ticking) {
        requestAnimationFrame(updateScrollPosition);
        ticking = true;
    }
}

function updateScrollPosition() {
    ticking = false;
}

$('#chatMessages').on('scroll', requestTick);
</script>

@endsection
