
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>Mobiglas Chat App</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div id="login-modal" class="modal hidden">
    <div class="modal-content">
      <h2>ログイン</h2>
      <input type="text" id="login-username" placeholder="ユーザー名" />
      <input type="password" id="login-password" placeholder="パスワード" />
      <button onclick="attemptLogin()">ログイン</button>
      <p>アカウントが必要ですか？ <a href="#" onclick="showRegisterModal()">新規登録</a></p>
    </div>
  </div>

  <div id="register-modal" class="modal hidden">
    <div class="modal-content">
      <h2>新規登録</h2>
      <input type="text" id="register-username" placeholder="ユーザー名" />
      <input type="password" id="register-password" placeholder="パスワード" />
      <button onclick="attemptRegister()">登録</button>
    </div>
  </div>

  <div class="navbar">
    <button onclick="switchTab('guild')">🛡 Guild</button>
    <button onclick="switchTab('friends')">👥 Friends</button>
    <button onclick="switchTab('party')">🧑‍🤝‍🧑 Party</button>
    <button onclick="switchTab('chat')">💬 Chat</button>
    <button onclick="switchTab('admin')">⚙️ Admin</button>
    <button onclick="logout()">🔓 Logout</button>
  </div>

  <div class="tab hidden" id="tab-guild">
    <h2>ギルド管理</h2>
    <div id="guild-info">ギルド情報をここに表示（管理者は編集可能）</div>
    <div id="guild-actions" class="admin-actions hidden">
      <button onclick="createGuild()">ギルド作成</button>
      <button onclick="deleteGuild()">ギルド削除</button>
    </div>
  </div>

  <div class="tab hidden" id="tab-friends">
    <h2>フレンド一覧</h2>
    <ul id="friend-list"></ul>
    <input type="text" id="friend-name" placeholder="ユーザー名を入力" />
    <button onclick="addFriend()">フレンド追加</button>
  </div>

  <div class="tab hidden" id="tab-party">
    <h2>パーティー管理</h2>
    <ul id="party-list"></ul>
    <input type="text" id="party-member" placeholder="ユーザー名を追加" />
    <button onclick="addPartyMember()">メンバー追加</button>
  </div>

  <div class="tab" id="tab-chat">
    <h2>チャットルーム</h2>
    <div class="chat-window" id="chat-window"></div>
    <div class="input-area">
      <button id="ai-button">🤖</button>
      <input type="text" id="message-input" placeholder="メッセージを入力..." />
      <button id="send-button">送信</button>
    </div>
  </div>

  <div class="tab hidden" id="tab-admin">
    <h2>管理者ページ</h2>
    <div>
      <button onclick="viewAllUsers()">全ユーザー表示</button>
      <button onclick="viewAllGuilds()">全ギルド表示</button>
      <button onclick="viewAllParties()">全パーティー表示</button>
      <button onclick="viewAllMessages()">チャットログ表示</button>
    </div>
    <div id="admin-content"></div>
  </div>

  <script src="script.js"></script>
</body>
</html>
