<!-- ============================================
     MODERN CHATBOT COMPONENT - DISLICORES AGS
     ============================================ -->

<!-- Floating Chat Button -->
<div class="chat-fab" id="chatFab" onclick="toggleChat()">
  <svg class="chat-fab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
  </svg>
  <span class="chat-fab-badge" id="chatBadge">1</span>
</div>

<!-- Chat Window -->
<div class="chat-widget" id="chatWidget">
  <!-- Chat Header -->
  <div class="chat-header">
    <div class="chat-header-content">
      <div class="chat-avatar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </div>
      <div class="chat-header-info">
        <h3 class="chat-header-title">Asistente Virtual</h3>
        <p class="chat-header-status">
          <span class="status-dot"></span>
          En línea
        </p>
      </div>
    </div>
    <button class="chat-close-btn" onclick="toggleChat()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <!-- Chat Messages -->
  <div class="chat-messages" id="chat">
    <!-- Welcome Message -->
    <div class="message-wrapper bot-message">
      <div class="message-avatar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </div>
      <div class="message-content">
        <div class="message-bubble bot">
          <p>¡Hola! 👋 Bienvenido a <strong>DISLICORES AGS</strong>. ¿En qué puedo ayudarte hoy?</p>
        </div>
        <span class="message-time">Ahora</span>
      </div>
    </div>
  </div>

  <!-- Typing Indicator -->
  <div class="typing-indicator" id="typingIndicator" style="display: none;">
    <div class="typing-avatar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
    </div>
    <div class="typing-dots">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <!-- Chat Input -->
  <div class="chat-input-container">
    <div class="chat-input-wrapper">
      <input 
        id="msg" 
        type="text" 
        placeholder="Escribe tu mensaje..." 
        class="chat-input"
        onkeypress="handleKeyPress(event)"
      >
      <button onclick="send()" class="chat-send-btn" id="sendBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="22" y1="2" x2="11" y2="13"></line>
          <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
        </svg>
      </button>
    </div>
    <p class="chat-footer-text">Powered by DISLICORES AGS</p>
  </div>
</div>

<style>
/* ============================================
   CHATBOT STYLES
   ============================================ */

/* Floating Action Button */
.chat-fab {
  position: fixed;
  bottom: 24px;
  right: 24px;
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #d4af37 0%, #c19b2a 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 8px 16px rgba(212, 175, 55, 0.3), 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 1000;
  animation: pulse-fab 2s infinite;
}

@keyframes pulse-fab {
  0%, 100% {
    box-shadow: 0 8px 16px rgba(212, 175, 55, 0.3), 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  50% {
    box-shadow: 0 8px 24px rgba(212, 175, 55, 0.5), 0 4px 12px rgba(0, 0, 0, 0.15);
  }
}

.chat-fab:hover {
  transform: scale(1.1);
  box-shadow: 0 12px 24px rgba(212, 175, 55, 0.4), 0 6px 12px rgba(0, 0, 0, 0.15);
}

.chat-fab:active {
  transform: scale(0.95);
}

.chat-fab-icon {
  width: 28px;
  height: 28px;
  color: white;
}

.chat-fab-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  background: #ef4444;
  color: white;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 700;
  border: 3px solid white;
  animation: bounce-badge 0.5s ease;
}

@keyframes bounce-badge {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.2); }
}

/* Chat Widget */
.chat-widget {
  position: fixed;
  bottom: 100px;
  right: 24px;
  width: 400px;
  max-width: calc(100vw - 48px);
  height: 600px;
  max-height: calc(100vh - 150px);
  background: white;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
  display: none;
  flex-direction: column;
  overflow: hidden;
  z-index: 1001;
  animation: slideUp 0.3s ease-out;
}

.chat-widget.active {
  display: flex;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Chat Header */
.chat-header {
  background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
  color: white;
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.chat-header-content {
  display: flex;
  align-items: center;
  gap: 12px;
}

.chat-avatar {
  width: 45px;
  height: 45px;
  background: linear-gradient(135deg, #d4af37, #c19b2a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.chat-avatar svg {
  width: 24px;
  height: 24px;
  color: white;
}

.chat-header-info {
  flex: 1;
}

.chat-header-title {
  font-size: 16px;
  font-weight: 700;
  margin: 0;
  letter-spacing: -0.02em;
}

.chat-header-status {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.8);
  margin: 2px 0 0 0;
  display: flex;
  align-items: center;
  gap: 6px;
}

.status-dot {
  width: 8px;
  height: 8px;
  background: #22c55e;
  border-radius: 50%;
  animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.chat-close-btn {
  background: rgba(255, 255, 255, 0.1);
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.chat-close-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: rotate(90deg);
}

.chat-close-btn svg {
  width: 18px;
  height: 18px;
  color: white;
}

/* Chat Messages */
.chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
  background: #f8f9fa;
  scroll-behavior: smooth;
}

.chat-messages::-webkit-scrollbar {
  width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
  background: transparent;
}

.chat-messages::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
  background: #9ca3af;
}

.message-wrapper {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
  animation: fadeInMessage 0.3s ease;
}

@keyframes fadeInMessage {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.message-wrapper.user-message {
  flex-direction: row-reverse;
}

.message-avatar {
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #d4af37, #c19b2a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.message-avatar svg {
  width: 18px;
  height: 18px;
  color: white;
}

.user-message .message-avatar {
  background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
}

.message-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.user-message .message-content {
  align-items: flex-end;
}

.message-bubble {
  max-width: 75%;
  padding: 12px 16px;
  border-radius: 16px;
  font-size: 14px;
  line-height: 1.5;
  word-wrap: break-word;
}

.message-bubble.bot {
  background: white;
  color: #1a1a1a;
  border: 1px solid #e5e7eb;
  border-bottom-left-radius: 4px;
}

.message-bubble.user {
  background: linear-gradient(135deg, #d4af37, #c19b2a);
  color: white;
  border-bottom-right-radius: 4px;
}

.message-bubble p {
  margin: 0;
}

.message-bubble strong {
  font-weight: 700;
}

.message-time {
  font-size: 11px;
  color: #9ca3af;
  padding: 0 8px;
}

/* Typing Indicator */
.typing-indicator {
  display: flex;
  gap: 10px;
  padding: 0 20px 20px;
  background: #f8f9fa;
}

.typing-avatar {
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #d4af37, #c19b2a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.typing-avatar svg {
  width: 18px;
  height: 18px;
  color: white;
}

.typing-dots {
  background: white;
  border: 1px solid #e5e7eb;
  padding: 12px 16px;
  border-radius: 16px;
  border-bottom-left-radius: 4px;
  display: flex;
  gap: 4px;
}

.typing-dots span {
  width: 8px;
  height: 8px;
  background: #9ca3af;
  border-radius: 50%;
  animation: typing 1.4s infinite;
}

.typing-dots span:nth-child(2) {
  animation-delay: 0.2s;
}

.typing-dots span:nth-child(3) {
  animation-delay: 0.4s;
}

@keyframes typing {
  0%, 60%, 100% {
    transform: translateY(0);
    opacity: 0.7;
  }
  30% {
    transform: translateY(-8px);
    opacity: 1;
  }
}

/* Chat Input */
.chat-input-container {
  background: white;
  border-top: 1px solid #e5e7eb;
  padding: 16px;
}

.chat-input-wrapper {
  display: flex;
  gap: 8px;
  margin-bottom: 8px;
}

.chat-input {
  flex: 1;
  padding: 12px 16px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 14px;
  font-family: inherit;
  outline: none;
  transition: all 0.2s ease;
}

.chat-input:focus {
  border-color: #d4af37;
  box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.chat-input::placeholder {
  color: #9ca3af;
}

.chat-send-btn {
  width: 44px;
  height: 44px;
  background: linear-gradient(135deg, #d4af37, #c19b2a);
  border: none;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.chat-send-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
}

.chat-send-btn:active {
  transform: translateY(0);
}

.chat-send-btn svg {
  width: 20px;
  height: 20px;
  color: white;
}

.chat-footer-text {
  text-align: center;
  font-size: 11px;
  color: #9ca3af;
  margin: 0;
}

/* Responsive */
@media (max-width: 480px) {
  .chat-widget {
    width: calc(100vw - 24px);
    height: calc(100vh - 120px);
    right: 12px;
    bottom: 90px;
  }
  
  .chat-fab {
    bottom: 16px;
    right: 16px;
  }
}
</style>

<script>
// Chat functionality
let chatOpen = false;

function toggleChat() {
  const widget = document.getElementById('chatWidget');
  const fab = document.getElementById('chatFab');
  const badge = document.getElementById('chatBadge');
  
  chatOpen = !chatOpen;
  
  if (chatOpen) {
    widget.classList.add('active');
    fab.style.display = 'none';
    badge.style.display = 'none';
    scrollToBottom();
  } else {
    widget.classList.remove('active');
    fab.style.display = 'flex';
  }
}

function handleKeyPress(event) {
  if (event.key === 'Enter') {
    send();
  }
}

async function send() {
  const msgInput = document.getElementById('msg');
  const msg = msgInput.value.trim();
  const chat = document.getElementById('chat');
  const typingIndicator = document.getElementById('typingIndicator');
  
  if (!msg) return;
  
  // Añadir mensaje del usuario
  const userMessageHTML = `
    <div class="message-wrapper user-message">
      <div class="message-avatar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </div>
      <div class="message-content">
        <div class="message-bubble user">
          <p>${escapeHtml(msg)}</p>
        </div>
        <span class="message-time">Ahora</span>
      </div>
    </div>
  `;
  
  chat.innerHTML += userMessageHTML;
  msgInput.value = '';
  scrollToBottom();
  
  // Mostrar indicador de escritura
  typingIndicator.style.display = 'flex';
  scrollToBottom();
  
  try {
    const res = await fetch('/api/chat', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ message: msg })
    });
    
    const data = await res.json();
    
    // Ocultar indicador de escritura
    typingIndicator.style.display = 'none';
    
    // Añadir respuesta del bot
    const botMessageHTML = `
      <div class="message-wrapper bot-message">
        <div class="message-avatar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </div>
        <div class="message-content">
          <div class="message-bubble bot">
            <p>${escapeHtml(data.reply)}</p>
          </div>
          <span class="message-time">Ahora</span>
        </div>
      </div>
    `;
    
    chat.innerHTML += botMessageHTML;
    scrollToBottom();
    
  } catch (error) {
    typingIndicator.style.display = 'none';
    console.error('Error:', error);
    
    const errorMessageHTML = `
      <div class="message-wrapper bot-message">
        <div class="message-avatar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </div>
        <div class="message-content">
          <div class="message-bubble bot">
            <p>❌ Lo siento, hubo un error al procesar tu mensaje. Por favor, intenta de nuevo.</p>
          </div>
          <span class="message-time">Ahora</span>
        </div>
      </div>
    `;
    
    chat.innerHTML += errorMessageHTML;
    scrollToBottom();
  }
}

function scrollToBottom() {
  const chat = document.getElementById('chat');
  setTimeout(() => {
    chat.scrollTop = chat.scrollHeight;
  }, 100);
}

function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

// Auto-hide badge after first interaction
document.getElementById('msg')?.addEventListener('focus', function() {
  const badge = document.getElementById('chatBadge');
  if (badge) badge.style.display = 'none';
});
</script>