(function () {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        return;
    }

    const csrfToken = csrfMeta.getAttribute('content');
    const statusClassMap = {
        'belum bayar': 'bg-danger-subtle text-danger-emphasis',
        pending: 'bg-warning-subtle text-warning-emphasis',
        diproses: 'bg-primary-subtle text-primary-emphasis',
        dikirim: 'bg-info-subtle text-info-emphasis',
        completed: 'bg-success-subtle text-success-emphasis',
    };

    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID').format(Number(value) || 0);
    }

    function updateSummary(summary) {
        if (!summary) {
            return;
        }
        document.querySelectorAll('[data-summary-key]').forEach((el) => {
            const key = el.getAttribute('data-summary-key');
            if (!(key in summary)) {
                return;
            }
            if (key === 'revenue') {
                el.textContent = 'Rp' + formatNumber(summary[key]);
            } else {
                el.textContent = formatNumber(summary[key]);
            }
        });
    }

    function updateStatusBadge(orderId, status) {
        const badge = document.querySelector(`.status-badge[data-order-id="${orderId}"]`);
        if (!badge) {
            return;
        }

        badge.className = 'badge text-uppercase status-badge ' + (statusClassMap[status] || 'bg-secondary-subtle text-secondary-emphasis');
        badge.textContent = status;
    }

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!form.classList.contains('js-order-status-form')) {
            return;
        }
        event.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.dataset.originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menyimpan...';
        }

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: new FormData(form),
        })
            .then(async (response) => {
                if (!response.ok) {
                    const message = await response.text();
                    throw new Error(message || 'Gagal memperbarui status.');
                }
                return response.json();
            })
            .then((data) => {
                if (data.order_id && data.status) {
                    updateStatusBadge(data.order_id, data.status);
                }
                updateSummary(data.summary);
            })
            .catch((error) => {
                console.error(error);
                form.submit();
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = submitBtn.dataset.originalText || 'Simpan';
                }
            });
    });
})();
