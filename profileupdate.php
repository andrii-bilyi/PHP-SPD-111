<div class="col s12 m7">
    <h2 class="header">Профіль користувача</h2>
    <div class="card horizontal">
        <div class="card-image">
            <img src="/avatar/<?php echo $user['avatar']; ?>" alt="/avatar/MicrosoftTeams-image.png">
        </div>
        <form method="post">
        <div class="card-stacked">
            <div class="row card-content">
                <div class="row"></div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" name="user-name" value="<?php echo $user['name']; ?>" class="validate">
                        <label for="icon_prefix">П.І.Б.</label>
                        <span class="helper-text"
                            data-error="Це необхідне поле"
                            data-success="Правильно">Прізвище, ім'я, по-батькові</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">mail</i>
                        <input  id="icon_email" type="email"  name="user-email" value="<?php echo $user['email']; ?>" class="validate">
                        <label for="icon_email">E-mail</label>
                        <span class="helper-text"
                            data-error="Це необхідне поле"
                            data-success="Правильно">Адреса електронної пошти</span>
                    </div>            
                    <div class="input-field col s6">
                        <i class="material-icons prefix">lock</i>
                        <input  id="icon_password" type="password" name="user-password" >
                        <label for="icon_password">Пароль</label>
                        <span class="helper-text"
                            data-error="Це необхідне поле"
                            data-success="Припустимо">Придумайте пароль</span>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn indigo">
                            <i class="material-icons">photo</i>
                            <input type="file" name="user-avatar">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Аватарка">
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <button type="button" id="update-button" class="btn indigo right"><i class="material-icons left">task_alt</i>Зберігти</button>
                    </div>
                </div>        
            </div>
        </div>
        </form>        
    </div>
</div>

