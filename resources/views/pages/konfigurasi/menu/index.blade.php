<x-master-layout>

    @push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/menu.css') }}">

    <style>
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: "Poppins", sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(168, 213, 229, 0.4);
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(168, 213, 229, 0.5);
        }

        .btn-add i {
            font-size: 1.1rem;
        }

        /* User Card Container */
        .user-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        /* User Card Container */
        .user-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        /* Filter Section */
        .filter-section {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 15px 10px 42px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: "Poppins", sans-serif;
            background: var(--card-bg);
            color: var(--text-primary);
            width: 280px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-soft);
            box-shadow: 0 0 0 4px rgba(168, 213, 229, 0.15);
        }

        .search-box input::placeholder {
            color: var(--text-secondary);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Custom Dropdown Select */
        .custom-select {
            position: relative;
            min-width: 160px;
            user-select: none;
        }

        .custom-select.entries {
            min-width: 80px;
        }

        .custom-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 10px;
        }

        .custom-select-trigger span {
            font-size: 0.9rem;
            color: var(--text-primary);
            font-family: "Poppins", sans-serif;
        }

        .custom-select.entries .custom-select-trigger span {
            font-size: 0.85rem;
        }

        .custom-select-trigger i {
            font-size: 0.75rem;
            color: var(--text-secondary);
            transition: transform 0.3s ease;
        }

        .custom-select.open .custom-select-trigger i {
            transform: rotate(180deg);
        }

        .custom-select-trigger:hover,
        .custom-select.open .custom-select-trigger {
            border-color: var(--primary-soft);
        }

        .custom-select.open .custom-select-trigger {
            box-shadow: 0 0 0 4px rgba(168, 213, 229, 0.15);
        }

        .custom-options {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 40px var(--shadow-color);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
            max-height: 250px;
            overflow-y: auto;
        }

        .custom-select.open .custom-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .custom-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-primary);
            font-family: "Poppins", sans-serif;
            transition: all 0.2s ease;
        }

        .custom-select.entries .custom-option {
            font-size: 0.85rem;
            padding: 8px 14px;
        }

        .custom-option:hover {
            background: var(--sidebar-hover);
        }

        .custom-option.selected {
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            color: #fff;
        }

        .custom-option.selected:hover {
            background: linear-gradient(135deg, #9bcadb, #d4c6ed);
        }

        /* Option indicators */
        .option-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .option-dot.active {
            background: #48bb78;
        }

        .option-dot.inactive {
            background: #f56565;
        }

        .option-badge {
            width: 12px;
            height: 12px;
            border-radius: 4px;
        }

        .option-badge.admin {
            background: linear-gradient(135deg, #9f7aea, #b794f4);
        }

        .option-badge.editor {
            background: linear-gradient(135deg, #4299e1, #63b3ed);
        }

        .option-badge.user {
            background: linear-gradient(135deg, #ed8936, #f6ad55);
        }

        .custom-option.selected .option-dot,
        .custom-option.selected .option-badge {
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }

        .filter-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .entries-info {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table thead {
            background: var(--sidebar-hover);
        }

        .user-table th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .user-table th.sortable {
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
        }

        .user-table th.sortable:hover {
            background: rgba(168, 213, 229, 0.2);
        }

        .user-table th .sort-icon {
            margin-left: 5px;
            font-size: 0.75rem;
            opacity: 0.5;
        }

        .user-table th.sorted .sort-icon {
            opacity: 1;
            color: var(--primary-soft);
        }

        .user-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .user-table tbody tr:hover {
            background: var(--sidebar-hover);
        }

        .user-table td {
            padding: 15px 20px;
            font-size: 0.9rem;
            color: var(--text-primary);
            vertical-align: middle;
        }

        /* User Info Cell */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .user-info-details h6 {
            margin: 0 0 2px 0;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .user-info-details span {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-badge.active {
            background: rgba(72, 187, 120, 0.15);
            color: #2f855a;
        }

        .status-badge.inactive {
            background: rgba(245, 101, 101, 0.15);
            color: #c53030;
        }

        .status-badge i {
            font-size: 0.5rem;
        }

        /* Role Badge */
        .role-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .role-badge.admin {
            background: rgba(159, 122, 234, 0.15);
            color: #6b46c1;
        }

        .role-badge.editor {
            background: rgba(66, 153, 225, 0.15);
            color: #2b6cb0;
        }

        .role-badge.user {
            background: rgba(237, 137, 54, 0.15);
            color: #c05621;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-action.detail {
            background: rgba(66, 153, 225, 0.15);
            color: #3182ce;
        }

        .btn-action.detail:hover {
            background: #3182ce;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-action.edit {
            background: rgba(237, 137, 54, 0.15);
            color: #dd6b20;
        }

        .btn-action.edit:hover {
            background: #dd6b20;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-action.delete {
            background: rgba(245, 101, 101, 0.15);
            color: #e53e3e;
        }

        .btn-action.delete:hover {
            background: #e53e3e;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Pagination */
        .pagination-section {
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .page-btn {
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border: none;
            border-radius: 10px;
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-family: "Poppins", sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn:hover:not(.active):not(:disabled) {
            background: var(--sidebar-hover);
            color: var(--text-primary);
        }

        .page-btn.active {
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            color: #fff;
            font-weight: 500;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-btn i {
            font-size: 0.85rem;
        }

        /* ==================== USER MODAL STYLES ==================== */
        .user-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .user-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .user-modal-content {
            background: var(--card-bg);
            border-radius: 24px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.8) translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
        }

        .user-modal.show .user-modal-content {
            transform: scale(1) translateY(0);
        }

        .user-modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-modal-header h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-modal-header h3 i {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .user-modal-header h3 i.add-icon {
            background: linear-gradient(135deg,
                    rgba(72, 187, 120, 0.15),
                    rgba(72, 187, 120, 0.25));
            color: #38a169;
        }

        .user-modal-header h3 i.edit-icon {
            background: linear-gradient(135deg,
                    rgba(237, 137, 54, 0.15),
                    rgba(237, 137, 54, 0.25));
            color: #dd6b20;
        }

        .user-modal-header h3 i.detail-icon {
            background: linear-gradient(135deg,
                    rgba(66, 153, 225, 0.15),
                    rgba(66, 153, 225, 0.25));
            color: #3182ce;
        }

        .btn-close-modal {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 10px;
            background: var(--sidebar-hover);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close-modal:hover {
            background: rgba(245, 101, 101, 0.15);
            color: #e53e3e;
            transform: rotate(90deg);
        }

        .user-modal-body {
            padding: 25px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #e53e3e;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: "Poppins", sans-serif;
            background: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary-soft);
            box-shadow: 0 0 0 4px rgba(168, 213, 229, 0.15);
        }

        .form-control-custom::placeholder {
            color: var(--text-secondary);
        }

        .form-control-custom:disabled {
            background: var(--sidebar-hover);
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-switch-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: var(--sidebar-hover);
            border-radius: 12px;
        }

        .form-switch-group span {
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .form-switch {
            position: relative;
            width: 50px;
            height: 28px;
        }

        .form-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .form-switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--border-color);
            border-radius: 28px;
            transition: all 0.3s ease;
        }

        .form-switch .slider::before {
            content: "";
            position: absolute;
            width: 22px;
            height: 22px;
            left: 3px;
            bottom: 3px;
            background: #fff;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-switch input:checked+.slider {
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
        }

        .form-switch input:checked+.slider::before {
            transform: translateX(22px);
        }

        .user-modal-footer {
            padding: 20px 30px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-modal {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            font-family: "Poppins", sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-modal.cancel {
            background: var(--sidebar-hover);
            color: var(--text-primary);
        }

        .btn-modal.cancel:hover {
            background: var(--border-color);
        }

        .btn-modal.save {
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            color: #fff;
            box-shadow: 0 4px 15px rgba(168, 213, 229, 0.4);
        }

        .btn-modal.save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 213, 229, 0.5);
        }

        /* Delete Modal Specific */
        .delete-modal .user-modal-content {
            max-width: 420px;
            text-align: center;
        }

        .delete-modal .user-modal-body {
            padding: 40px 30px;
        }

        .delete-icon-wrapper {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg,
                    rgba(245, 101, 101, 0.1),
                    rgba(252, 129, 129, 0.15));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-5px) rotate(-5deg);
            }

            40% {
                transform: translateX(5px) rotate(5deg);
            }

            60% {
                transform: translateX(-5px) rotate(-5deg);
            }

            80% {
                transform: translateX(5px) rotate(5deg);
            }
        }

        .delete-icon-wrapper i {
            font-size: 2.8rem;
            color: #e53e3e;
        }

        .delete-modal h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        .delete-modal p {
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .delete-modal .user-to-delete {
            font-weight: 600;
            color: var(--text-primary);
            background: var(--sidebar-hover);
            padding: 8px 16px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 25px;
        }

        .delete-modal .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-delete {
            padding: 12px 28px;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: "Poppins", sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-delete.cancel {
            background: var(--sidebar-hover);
            color: var(--text-primary);
        }

        .btn-delete.cancel:hover {
            background: var(--border-color);
        }

        .btn-delete.confirm {
            background: linear-gradient(135deg, #f56565, #fc8181);
            color: #fff;
            box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
        }

        .btn-delete.confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
        }

        /* Detail Modal */
        .detail-modal .user-modal-content {
            max-width: 480px;
        }

        .detail-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg,
                    var(--primary-soft),
                    var(--purple-soft));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(168, 213, 229, 0.4);
        }

        .detail-name {
            text-align: center;
            margin-bottom: 25px;
        }

        .detail-name h4 {
            margin: 0 0 5px 0;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .detail-name span {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .detail-info-list {
            background: var(--sidebar-hover);
            border-radius: 16px;
            padding: 5px;
        }

        .detail-info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .detail-info-item:hover {
            background: var(--card-bg);
        }

        .detail-info-item .label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .detail-info-item .label i {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .detail-info-item .value {
            font-weight: 500;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        /* ==================== USER PAGE RESPONSIVE ==================== */
        @media (max-width: 992px) {
            .filter-section {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-left {
                width: 100%;
            }

            .search-box {
                flex: 1;
            }

            .search-box input {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .filter-left {
                flex-direction: column;
            }

            .custom-select {
                width: 100%;
            }

            .custom-select.entries {
                width: auto;
                min-width: 80px;
            }

            .user-table th,
            .user-table td {
                padding: 12px 15px;
            }

            .user-info-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.85rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn-action {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }

            .pagination-section {
                flex-direction: column;
                text-align: center;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .user-modal-footer {
                flex-direction: column;
            }

            .btn-modal {
                width: 100%;
                justify-content: center;
            }

            .delete-modal .modal-buttons {
                flex-direction: column;
            }

            .btn-delete {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .user-table {
                font-size: 0.85rem;
            }

            .hide-mobile {
                display: none;
            }

            .page-btn {
                min-width: 34px;
                height: 34px;
                font-size: 0.85rem;
            }
        }

    </style>
    @endpush

    @push('js')
    <script>
        // Initialize AOS
        AOS.init({
            once: true
            , easing: "ease-out-cubic"
            , duration: 800
        });

        // ==================== USER PAGE SCRIPTS ====================

        function showAddModal() {
            document.getElementById("addUserModal").classList.add("show");
        }

        function hideAddModal() {
            document.getElementById("addUserModal").classList.remove("show");
        }

        function showEditModal(name) {
            document.getElementById("editName").value = name;
            document.getElementById("editUserModal").classList.add("show");
        }

        function hideEditModal() {
            document.getElementById("editUserModal").classList.remove("show");
        }

        function showDetailModal(name, email) {
            const initials = name
                .split(" ")
                .map((n) => n[0])
                .join("")
                .toUpperCase();
            document.getElementById("detailAvatar").textContent = initials;
            document.getElementById("detailName").textContent = name;
            document.getElementById("detailEmail").textContent = email;
            document.getElementById("detailUserModal").classList.add("show");
        }

        function hideDetailModal() {
            document.getElementById("detailUserModal").classList.remove("show");
        }

        function showDeleteModal(name) {
            document.getElementById("userToDelete").textContent = name;
            document.getElementById("deleteUserModal").classList.add("show");
        }

        function hideDeleteModal() {
            document.getElementById("deleteUserModal").classList.remove("show");
        }

        document.querySelectorAll(".user-modal").forEach((modal) => {
            modal.addEventListener("click", (e) => {
                if (e.target === modal) modal.classList.remove("show");
            });
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                document
                    .querySelectorAll(".user-modal.show")
                    .forEach((modal) => modal.classList.remove("show"));
                document
                    .querySelectorAll(".custom-select.open")
                    .forEach((select) => select.classList.remove("open"));
                hideLogoutModal();
            }
        });

        // ==================== CUSTOM DROPDOWN ====================

        document.querySelectorAll(".custom-select").forEach((select) => {
            const trigger = select.querySelector(".custom-select-trigger");
            const options = select.querySelectorAll(".custom-option");
            const triggerSpan = trigger.querySelector("span");

            // Toggle dropdown
            trigger.addEventListener("click", (e) => {
                e.stopPropagation();
                // Close other dropdowns
                document.querySelectorAll(".custom-select.open").forEach((s) => {
                    if (s !== select) s.classList.remove("open");
                });
                select.classList.toggle("open");
            });

            // Select option
            options.forEach((option) => {
                option.addEventListener("click", () => {
                    // Remove selected from all options
                    options.forEach((opt) => opt.classList.remove("selected"));
                    // Add selected to clicked option
                    option.classList.add("selected");
                    // Update trigger text
                    triggerSpan.textContent = option.textContent.trim();
                    // Update data-value
                    select.dataset.value = option.dataset.value;
                    // Close dropdown
                    select.classList.remove("open");
                });
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".custom-select")) {
                document.querySelectorAll(".custom-select.open").forEach((select) => {
                    select.classList.remove("open");
                });
            }
        });

    </script>
    @endpush

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>{{ $title }}</h1>
            <p>{{ $subtitle }}</p>
        </div>
        <div class="page-header-right">
            <nav class="breadcrumb-nav">
                <a href="dashboard.html"><i class="bi bi-house"></i> Home</a>
                <span class="separator"><i class="bi bi-chevron-right"></i></span>
                <span class="current">{{ $title }}</span>
            </nav>
        </div>
    </div>

    <!-- Content Area - Tambahkan konten Anda di sini -->
    <div class="content-wrapper">


        <!-- Contoh Grid 3 Kolom -->
        <div class="grid-3">
            <div class="card card-mini">
                <div class="card-body">
                    <div class="mini-stat">
                        <div class="mini-stat-icon primary"><i class="bi bi-people"></i></div>
                        <div class="mini-stat-info">
                            <span class="mini-stat-value">1,234</span>
                            <span class="mini-stat-label">Total Menu</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-mini">
                <div class="card-body">
                    <div class="mini-stat">
                        <div class="mini-stat-icon success"><i class="bi bi-cart-check"></i></div>
                        <div class="mini-stat-info">
                            <span class="mini-stat-value">567</span>
                            <span class="mini-stat-label">Menu Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-mini">
                <div class="card-body">
                    <div class="mini-stat">
                        <div class="mini-stat-icon warning"><i class="bi bi-currency-dollar"></i></div>
                        <div class="mini-stat-info">
                            <span class="mini-stat-value">Rp 12.5M</span>
                            <span class="mini-stat-label">Menu Tidak Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contoh Card Kosong -->
        <div class="card">
            <div class="card-header">
                <h3><i class="bi bi-file-earmark-text"></i> {{ $label }}</h3>
                <div class="card-actions">
                    <button class="btn-add" onclick="showAddModal()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah User
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="user-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="filter-section">
                        <div class="filter-left">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" placeholder="Cari nama, email, atau username..." />
                            </div>

                            <!-- Custom Dropdown Status -->
                            <div class="custom-select" data-value="">
                                <div class="custom-select-trigger">
                                    <span>Semua Status</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option selected" data-value="">
                                        Semua Status
                                    </div>
                                    <div class="custom-option" data-value="active">
                                        <span class="option-dot active"></span>Active
                                    </div>
                                    <div class="custom-option" data-value="inactive">
                                        <span class="option-dot inactive"></span>Inactive
                                    </div>
                                </div>
                            </div>

                            <!-- Custom Dropdown Role -->
                            <div class="custom-select" data-value="">
                                <div class="custom-select-trigger">
                                    <span>Semua Role</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option selected" data-value="">
                                        Semua Role
                                    </div>
                                    <div class="custom-option" data-value="admin">
                                        <span class="option-badge admin"></span>Admin
                                    </div>
                                    <div class="custom-option" data-value="editor">
                                        <span class="option-badge editor"></span>Editor
                                    </div>
                                    <div class="custom-option" data-value="user">
                                        <span class="option-badge user"></span>User
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-right">
                            <span class="entries-info">Tampilkan</span>

                            <!-- Custom Dropdown Entries -->
                            <div class="custom-select entries" data-value="10">
                                <div class="custom-select-trigger">
                                    <span>10</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option selected" data-value="10">10</div>
                                    <div class="custom-option" data-value="25">25</div>
                                    <div class="custom-option" data-value="50">50</div>
                                    <div class="custom-option" data-value="100">100</div>
                                </div>
                            </div>

                            <span class="entries-info">data</span>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th class="sortable sorted">
                                        No<i class="bi bi-arrow-down sort-icon"></i>
                                    </th>
                                    <th class="sortable">
                                        User<i class="bi bi-arrow-down-up sort-icon"></i>
                                    </th>
                                    <th class="sortable hide-mobile">
                                        Username<i class="bi bi-arrow-down-up sort-icon"></i>
                                    </th>
                                    <th class="sortable">
                                        Role<i class="bi bi-arrow-down-up sort-icon"></i>
                                    </th>
                                    <th class="sortable">
                                        Status<i class="bi bi-arrow-down-up sort-icon"></i>
                                    </th>
                                    <th class="hide-mobile">Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-info-avatar">AS</div>
                                            <div class="user-info-details">
                                                <h6>Ahmad Suryadi</h6>
                                                <span>ahmad@email.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-mobile">ahmad.suryadi</td>
                                    <td><span class="role-badge admin">Admin</span></td>
                                    <td>
                                        <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                                    </td>
                                    <td class="hide-mobile">12 Jan 2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail" onclick="
                                    showDetailModal('Ahmad Suryadi', 'ahmad@email.com')
                                  ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="showEditModal('Ahmad Suryadi')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus" onclick="showDeleteModal('Ahmad Suryadi')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-info-avatar">SN</div>
                                            <div class="user-info-details">
                                                <h6>Siti Nurhaliza</h6>
                                                <span>siti@email.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-mobile">siti.nurhaliza</td>
                                    <td><span class="role-badge editor">Editor</span></td>
                                    <td>
                                        <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                                    </td>
                                    <td class="hide-mobile">15 Jan 2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail" onclick="
                                    showDetailModal('Siti Nurhaliza', 'siti@email.com')
                                  ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="showEditModal('Siti Nurhaliza')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus" onclick="showDeleteModal('Siti Nurhaliza')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-info-avatar">BP</div>
                                            <div class="user-info-details">
                                                <h6>Budi Prasetyo</h6>
                                                <span>budi@email.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-mobile">budi.prasetyo</td>
                                    <td><span class="role-badge user">User</span></td>
                                    <td>
                                        <span class="status-badge inactive"><i class="bi bi-circle-fill"></i>Inactive</span>
                                    </td>
                                    <td class="hide-mobile">18 Jan 2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail" onclick="
                                    showDetailModal('Budi Prasetyo', 'budi@email.com')
                                  ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="showEditModal('Budi Prasetyo')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus" onclick="showDeleteModal('Budi Prasetyo')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-info-avatar">DW</div>
                                            <div class="user-info-details">
                                                <h6>Dewi Wulandari</h6>
                                                <span>dewi@email.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-mobile">dewi.wulandari</td>
                                    <td><span class="role-badge editor">Editor</span></td>
                                    <td>
                                        <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                                    </td>
                                    <td class="hide-mobile">20 Jan 2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail" onclick="
                                    showDetailModal('Dewi Wulandari', 'dewi@email.com')
                                  ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="showEditModal('Dewi Wulandari')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus" onclick="showDeleteModal('Dewi Wulandari')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-info-avatar">RH</div>
                                            <div class="user-info-details">
                                                <h6>Rizki Hidayat</h6>
                                                <span>rizki@email.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-mobile">rizki.hidayat</td>
                                    <td><span class="role-badge admin">Admin</span></td>
                                    <td>
                                        <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                                    </td>
                                    <td class="hide-mobile">22 Jan 2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail" onclick="
                                    showDetailModal('Rizki Hidayat', 'rizki@email.com')
                                  ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="showEditModal('Rizki Hidayat')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus" onclick="showDeleteModal('Rizki Hidayat')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-section">
                        <div class="pagination-info">Menampilkan 1-5 dari 12 data</div>
                        <div class="pagination">
                            <button class="page-btn" disabled>
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>


    <!-- Add User Modal -->
    <div class="user-modal" id="addUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-person-plus add-icon"></i>Tambah User Baru</h3>
                <button class="btn-close-modal" onclick="hideAddModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" class="form-control-custom" placeholder="Masukkan nama lengkap" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Username <span class="required">*</span></label>
                        <input type="text" class="form-control-custom" placeholder="Masukkan username" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" class="form-control-custom" placeholder="Masukkan email" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" class="form-control-custom" placeholder="Masukkan password" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" class="form-control-custom" placeholder="Konfirmasi password" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Role <span class="required">*</span></label>
                    <select class="form-control-custom">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-switch-group">
                        <span>Status Aktif</span>
                        <label class="form-switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideAddModal()">
                    <i class="bi bi-x"></i>Batal
                </button>
                <button class="btn-modal save">
                    <i class="bi bi-check-lg"></i>Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="user-modal" id="editUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-pencil-square edit-icon"></i>Edit User</h3>
                <button class="btn-close-modal" onclick="hideEditModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" class="form-control-custom" id="editName" value="Ahmad Suryadi" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Username <span class="required">*</span></label>
                        <input type="text" class="form-control-custom" value="ahmad.suryadi" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" class="form-control-custom" value="ahmad@email.com" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control-custom" placeholder="Kosongkan jika tidak diubah" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control-custom" placeholder="Konfirmasi password baru" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Role <span class="required">*</span></label>
                    <select class="form-control-custom">
                        <option value="admin" selected>Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-switch-group">
                        <span>Status Aktif</span>
                        <label class="form-switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideEditModal()">
                    <i class="bi bi-x"></i>Batal
                </button>
                <button class="btn-modal save">
                    <i class="bi bi-check-lg"></i>Update
                </button>
            </div>
        </div>
    </div>

    <!-- Detail User Modal -->
    <div class="user-modal detail-modal" id="detailUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-person-badge detail-icon"></i>Detail User</h3>
                <button class="btn-close-modal" onclick="hideDetailModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="detail-avatar" id="detailAvatar">AS</div>
                <div class="detail-name">
                    <h4 id="detailName">Ahmad Suryadi</h4>
                    <span id="detailEmail">ahmad@email.com</span>
                </div>
                <div class="detail-info-list">
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-person"></i>Username</div>
                        <div class="value">ahmad.suryadi</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-shield-check"></i>Role</div>
                        <div class="value">
                            <span class="role-badge admin">Admin</span>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-toggle-on"></i>Status</div>
                        <div class="value">
                            <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-calendar3"></i>Bergabung</div>
                        <div class="value">12 Januari 2024</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label">
                            <i class="bi bi-clock-history"></i>Terakhir Login
                        </div>
                        <div class="value">Hari ini, 10:30</div>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideDetailModal()">
                    <i class="bi bi-x"></i>Tutup
                </button>
                <button class="btn-modal save" onclick="
              hideDetailModal();
              showEditModal('Ahmad Suryadi');
            ">
                    <i class="bi bi-pencil"></i>Edit User
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="user-modal delete-modal" id="deleteUserModal">
        <div class="user-modal-content">
            <div class="user-modal-body">
                <div class="delete-icon-wrapper"><i class="bi bi-trash3"></i></div>
                <h3>Hapus User?</h3>
                <p>Anda yakin ingin menghapus user ini?</p>
                <div class="user-to-delete" id="userToDelete">Ahmad Suryadi</div>
                <p style="font-size: 0.85rem; color: var(--text-secondary)">
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="modal-buttons">
                    <button class="btn-delete cancel" onclick="hideDeleteModal()">
                        <i class="bi bi-x"></i>Batal
                    </button>
                    <button class="btn-delete confirm">
                        <i class="bi bi-trash"></i>Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
