// プロジェクト全体で再利用するコンポーネントをグローバルに定義していく
import Vue from 'vue';

import DeleteButton from '~/components/ui/buttons/DeleteButton';
import CancelButton from '~/components/ui/buttons/CancelButton';
import OpenModalButton from '~/components/ui/buttons/OpenModalButton';
import SubmitButton from '~/components/ui/buttons/SubmitButton';
import DeleteComfirm from '~/components/ui/modals/DeleteComfirm';
import AlertMessage from '~/components/ui/errors/AlertMessage';

Vue.mixin({
    components: {
        DeleteButton,
        CancelButton,
        DeleteComfirm,
        OpenModalButton,
        SubmitButton,
        AlertMessage
    }
});
