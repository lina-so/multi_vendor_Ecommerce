<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($newCount)
            <span class="badge badge-warning navbar-badge"  data-id="{{ $newCount }}">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>

        <div class="dropdown-divider"></div>
        @foreach ($allNotification as $notification)
            <div class="dropdown-divider"></div>
            <a href="#" data-id="{{ $notification->id }}" id="notification"
                class="dropdown-item @if ($notification->unread()) text-bold @endif" style="padding: 1.1rem 0rem;
            " onclick="MarkRead()">
                <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['body'] }}
                <span
                    class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}
                </span>

                {{-- <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }} </span> --}}
                {{-- <span class="float-right text-muted text-sm">{{ $notification->created_at->shortAbsoluteDiffForHumans() }} </span> --}}

            </a>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
