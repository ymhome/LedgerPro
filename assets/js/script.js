document.addEventListener('DOMContentLoaded', function() {

    // --- 要素の取得 ---
    const form = document.getElementById('device-action-form'); // 削除ボタンを含むフォーム
    const selectAllCheckbox = document.getElementById('device-select-all'); // 全選択チェックボックス
    const deviceCheckboxes = document.querySelectorAll('.device-checkbox'); // 個別の端末チェックボックス（複数）
    const selectedDeviceIdsInput = document.getElementById('selected_device_ids'); // ID格納用の隠しフィールド

    // --- 全選択/全解除 チェックボックスの処理 ---
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked; // 全選択チェックボックスの状態を取得
            deviceCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked; // 全ての端末チェックボックスの状態を合わせる
            });
        });
    }

    // --- 個別のチェックボックスが変更されたときの処理（全選択チェックボックスの状態更新）---
    deviceCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // もし個別のチェックボックスが一つでもチェック解除されたら、全選択チェックボックスも解除
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                // 全ての個別のチェックボックスがチェックされているか確認
                let allChecked = true;
                deviceCheckboxes.forEach(function(c) {
                    if (!c.checked) {
                        allChecked = false;
                    }
                });
                // 全てチェックされていれば、全選択チェックボックスもチェック
                selectAllCheckbox.checked = allChecked;
            }
        });
    });


    // --- フォーム送信時の処理 ---
    if (form) {
        form.addEventListener('submit', function(event) {
            // 選択されたIDを格納する配列
            const selectedIds = [];

            // チェックされている端末チェックボックスを探す
            deviceCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedIds.push(checkbox.value); // value（dev_id）を配列に追加
                }
            });

            // --- バリデーション：一つも選択されていない場合 ---
            if (selectedIds.length === 0) {
                alert('削除する項目を選択してください。');
                event.preventDefault(); // ★重要：フォームの送信を中止
                return; // ここで処理を終了
            }

            // --- 選択されたIDを隠しフィールドに設定 ---
            // 配列の要素をカンマ区切りで結合して文字列にする
            selectedDeviceIdsInput.value = selectedIds.join(',');

            // ★重要：ここで event.preventDefault() を呼ばないので、
            // フォームは通常通り ../function/device_delete.php に送信される
            // 確認のために削除前にダイアログを出す場合
            if (!confirm(selectedIds.length + '件の項目を削除します。よろしいですか？')) {
                 event.preventDefault(); // キャンセルされたら送信を中止
            }

        });
    }

});



// DOMContentLoaded の中に追記 or 分ける
const usrForm = document.getElementById('usr-action-form');
const usrSelectAll = document.getElementById('usr-select-all');
const usrCheckboxes = document.querySelectorAll('.usr-checkbox');
const selectedUsrIdsInput = document.getElementById('selected_usr_ids');

if (usrSelectAll) {
    usrSelectAll.addEventListener('change', function () {
        usrCheckboxes.forEach(c => c.checked = this.checked);
    });
}

usrCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        if (!this.checked) {
            usrSelectAll.checked = false;
        } else {
            usrSelectAll.checked = Array.from(usrCheckboxes).every(c => c.checked);
        }
    });
});

if (usrForm) {
    usrForm.addEventListener('submit', function (event) {
        const selectedIds = [];
        usrCheckboxes.forEach(c => {
            if (c.checked) selectedIds.push(c.value);
        });

        if (selectedIds.length === 0) {
            alert('削除するユーザーを選択してください。');
            event.preventDefault();
            return;
        }

        selectedUsrIdsInput.value = selectedIds.join(',');

        if (!confirm(selectedIds.length + '件のユーザーを削除します。よろしいですか？')) {
            event.preventDefault();
        }
    });
}
